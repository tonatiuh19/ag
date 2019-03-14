<?php
require_once('../cn.php');
require_once("../conekta/lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_VFZhVTcoqGSExTX65Jrsww");
\Conekta\Conekta::setApiVersion("2.0.0");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $monto = $_POST["monto"]*100;
  $reserva = $_POST["reserva"];
  
}
else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
   
    window.location.href='../';
    </SCRIPT>");
   
}

$sql = "SELECT reservas.id_reserva, usuarios.nombre, usuarios.apellido, usuarios.telefono, usuarios.email FROM reservas LEFT JOIN usuarios ON reservas.email = usuarios.email where id_reserva=".$reserva."";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
          $nombreA=$row["nombre"]." ".$row["apellido"];
          $correo=$row["email"];
         try{
            $order = \Conekta\Order::create(
              array(
                "line_items" => array(
                  array(
                    "name" => "reserva,".$reserva."",
                    "unit_price" => $monto,
                    "quantity" => 1
                  )//first line_item
                ), //line_items
                
                "currency" => "MXN",
                "customer_info" => array(
                  "name" => "".$nombreA."" ,
                  "email" => $correo,
                  "phone" => $row["telefono"]
                ), 
                
                "charges" => array(
                    array(
                        "payment_method" => array(
                            //"monthly_installments" => 3,
                            "type" => "oxxo_cash",
                                          ) //payment_method - use customer's default - a card
                          //to charge a card, different from the default,
                          //you can indicate the card's source_id as shown in the Retry Card Section
                    ) //first charge
                ) //charges
              )//order
            );
            $val = 0;
          } catch (\Conekta\ParameterValidationError $error){
          		$val = 1;
			  echo $error->getMessage();
			} catch (\Conekta\Handler $error){
				$val = 1;
			  echo $error->getMessage();
			} 

          if ($val == 1) {
                echo "<form action=\"../dashboard/sorry/\" id=\"my_form\" method=\"post\">\n";
                echo "  <input type=\"hidden\" name=\"error\" value=\"".$error->getMessage()."\">\n";  
                echo "<input type='submit' name='btnSignIn' value='Cargando...' id='btnSignIn' />\n";
                echo "</form>\n";
                echo "<script type=\"text/javascript\">\n"; 
                echo "    document.getElementById('btnSignIn').click();\n";
                echo "</script>\n"; 
          }else if($val == 0){
            /*echo "ID: ". $order->id;
			echo "Payment Method:". $order->charges[0]->payment_method->service_name;
			echo "Reference: ". $order->charges[0]->payment_method->reference;
			echo "$". $order->amount/100 . $order->currency;
			echo "Order";
			echo $order->line_items[0]->quantity .
			      "-". $order->line_items[0]->name .
			      "- $". $order->line_items[0]->unit_price/100;*/

           $sql = "INSERT INTO payconek (order_id, amount, customer_id, name, code, card_info, type, id_reserva, status)
            VALUES ('".$order->id."', '".$order->amount."', '".$order->currency."','".$order->line_items[0]->name."','".$order->charges[0]->payment_method->reference."', 'OXXO_PAY','2','".$reserva."','".$order->payment_status."')";

            if ($conn->query($sql) === TRUE) {
                echo "<form action=\"ticket/\" id=\"my_form\" method=\"post\">\n";
                echo "  <input type=\"hidden\" name=\"reserva\" value=\"".$reserva."\">\n";  
                echo "  <input type=\"hidden\" name=\"referencia\" value=\"".$order->charges[0]->payment_method->reference."\">\n";  
                echo "  <input type=\"hidden\" name=\"nombre\" value=\"".$nombreA."\">\n";
                echo "  <input type=\"hidden\" name=\"monto\" value=\"".$monto."\">\n";
                echo "  <input type=\"hidden\" name=\"correo\" value=\"".$correo."\">\n";    
                echo "<input type='submit' name='btnSignIn' value='Cargando...' id='btnSignIn' />\n";
                echo "</form>\n";
                echo "<script type=\"text/javascript\">\n"; 
                echo "    document.getElementById('btnSignIn').click();\n";
                echo "</script>\n"; 
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
          }
    }
} else {
    echo "0 results";
}



?>