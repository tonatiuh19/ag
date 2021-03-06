<?php
require_once("conekta/lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_VFZhVTcoqGSExTX65Jrsww");
\Conekta\Conekta::setApiVersion("2.0.0");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo $name = $_POST["conektaTokenId"];
  
}
else{
	/*echo ("<SCRIPT LANGUAGE='JavaScript'>
   
    window.location.href='payments.html';
    </SCRIPT>");*/
    echo "hola";
}




try {
  $customer = \Conekta\Customer::create(
    array(
      "name" => "Fulanito Pérez",
      "email" => "fulanito@conekta.com",
      "phone" => "+52181818181",
      "payment_sources" => array(
        array(
            "type" => "card",
            "token_id" => "tok_test_visa_4242"
        )
      )//payment_sources
    )//customer
  );
} catch (\Conekta\ProccessingError $error){
  echo $error->getMesage();
} catch (\Conekta\ParameterValidationError $error){
  echo $error->getMessage();
} catch (\Conekta\Handler $error){
  echo $error->getMessage();
}


try{
  $order = \Conekta\Order::create(
    array(
      "line_items" => array(
        array(
          "name" => "Tacos",
          "unit_price" => 1000,
          "quantity" => 12
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
        "customer_id" => "cus_2fkJPFjQKABcmiZWz"
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
                      "type" => "default"
              ) //payment_method - use customer's <code>default</code> - a card
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

echo "ID: ". $order->id;
echo "Status: ". $order->payment_status;
echo "$". $order->amount/100 . $order->currency;
echo "Order";
echo $order->line_items[0]->quantity .
      "-". $order->line_items[0]->name .
      "- $". $order->line_items[0]->unit_price/100;
echo "Payment info";
echo "CODE:". $order->charges[0]->payment_method->auth_code;
echo "Card info:" .
      "- ". $order->charges[0]->payment_method->name .
      "- <strong><strong>". $order->charges[0]->payment_method->last4 .
      "- ". $order->charges[0]->payment_method->brand .
      "- ". $order->charges[0]->payment_method->type;

?>





