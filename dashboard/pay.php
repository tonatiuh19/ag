<?php
require_once('cn.php');
require_once("conekta/lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_VFZhVTcoqGSExTX65Jrsww");
\Conekta\Conekta::setApiVersion("2.0.0");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["conektaTokenId"];
  $monto = $_POST["monto"]*100;
  $reserva = $_POST["reserva"];
  
}
else{
	/*echo ("<SCRIPT LANGUAGE='JavaScript'>
   
    window.location.href='payments.html';
    </SCRIPT>");*/
    echo "hola";
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
                    "unit_price" => 1000,
                    "quantity" => 120
                  )//first line_item
                ), //line_items
                "shipping_lines" => array(
                  array(
                    "amount" => 1500,
                     "carrier" => "FEDEX"
                  )
                ), //shipping_lines - physical goods only
                "currency" => "MXN",
                "customer_info" => array(
                  "name" => "nombre",
                  "email" => "<a href="mailto:usuario@gmail.com">usuario@gmail.com</a>",
                  "phone" => "5512345678"
                ), //customer_info
                "shipping_contact" => array(
                  "address" => array(
                    "street1" => "Calle 123, int 2",
                    "postal_code" => "06100",
                    "country" => "MX"
                  )//address
                ), //shipping_contact - required only for physical goods
                "metadata" => array("reference" => "12987324097", "more_info" => "lalalalala"),
                "charges" => array(
                    array(
                        "payment_method" => array(
                            //"monthly_installments" => 3,
                            "type" => "card",
                            "token_id" => "tok_test_visa_4242"              ) //payment_method - use customer's default - a card
                          //to charge a card, different from the default,
                          //you can indicate the card's source_id as shown in the Retry Card Section
                    ) //first charge
                ) //charges
              )//order
            );
          } catch (\Conekta\ProcessingError $error){
            echo $error->getMessage();
          } catch (\Conekta\ParameterValidationError $error){
            echo $error->getMessage();
          } catch (\Conekta\Handler $error){
            echo $error->getMessage();
          }

          if ($val == 1) {
                echo "<form action=\"../dashboard/sorry/\" id=\"my_form\" method=\"post\">\n";
                echo "  <input type=\"hidden\" name=\"error\" value=\"".$error->getMessage()."\">\n";  
                echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' />\n";
                echo "</form>\n";
                echo "<script type=\"text/javascript\">\n"; 
                echo "    document.getElementById('btnSignIn').click();\n";
                echo "</script>\n"; 
          }else if($val == 0){
            /*echo "ID: ". $order->id;
            echo "<br>";
            echo "Status: ". $order->payment_status;echo "<br>";*/

            $sql = "INSERT INTO payconek (order_id, amount, customer_id, name, code, card_info, type, id_reserva, status)
            VALUES ('".$order->id."', '".$order->amount."', '".$customer->id."','".$order->line_items[0]->name."','".$order->charges[0]->payment_method->auth_code."', '".$order->charges[0]->payment_method->last4 .
            "- ". $order->charges[0]->payment_method->brand .
            "- ". $order->charges[0]->payment_method->type."','2','".$reserva."','".$order->payment_status."')";

            if ($conn->query($sql) === TRUE) {
                echo "<form action=\"../dashboard/success/\" id=\"my_form\" method=\"post\">\n";
                echo "  <input type=\"hidden\" name=\"reserva\" value=\"".$reserva."\">\n";  
                echo "  <input type=\"hidden\" name=\"referencia\" value=\"".$order->id."\">\n";  
                echo "  <input type=\"hidden\" name=\"nombre\" value=\"".$nombreA."\">\n";
                echo "  <input type=\"hidden\" name=\"correo\" value=\"".$correo."\">\n";    
                echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' />\n";
                echo "</form>\n";
                echo "<script type=\"text/javascript\">\n"; 
                echo "    document.getElementById('btnSignIn').click();\n";
                echo "</script>\n"; 
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }


            /*echo "$". $order->amount . $order->currency;echo "<br>";
            echo "Order";echo "<br>";
            echo $order->line_items[0]->quantity .
            "-". $order->line_items[0]->name .
            "- $". $order->line_items[0]->unit_price;
            echo "<br>";
            echo "Payment info";echo "<br>";
            echo "CODE:". $order->charges[0]->payment_method->auth_code;echo "<br>";
            echo "Card info:" .
            "- ". $order->charges[0]->payment_method->name .
            "- <strong><strong>". $order->charges[0]->payment_method->last4 .
            "- ". $order->charges[0]->payment_method->brand .
            "- ". $order->charges[0]->payment_method->type;*/
          }
    }
} else {
    echo "0 results";
}






  ?>





