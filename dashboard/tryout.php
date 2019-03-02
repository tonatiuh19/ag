<?php
 try {
            $customer = \Conekta\Customer::create(
              array(
                "name" => $row["nombre"]." ".$row["apellido"],
                "email" => $row["email"],
                "phone" => $row["telefono"],
                "payment_sources" => array(
                  array(
                    "type" => "card",
                    "token_id" => "".$name.""
                  )
              )//payment_sources
            )//customer
            );
          } catch (\Conekta\ProccessingError $error){
            //echo $error->getMesage();
          } catch (\Conekta\ParameterValidationError $error){
            echo $error->getMessage();
          } catch (\Conekta\Handler $error){
            echo $error->getMessage();
          }
          echo "<br>";
          echo "customer ID: ". $customer->id;echo "<br>";
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
                  "customer_id" => "".$customer->id.""
              ), //customer_info
                //shipping_contact - required only for physical goods
                "metadata" => array("reference" => "12987324097", "more_info" => "lalalalala"),
                "charges" => array(
                  array(
                    "payment_method" => array(
                      "type" => "default"
                      ) //payment_method - use customer's <code>default</code> - a card
                  ) //first charge
              ) //charges
            )//order
            );$val = 0;
          } catch (\Conekta\ProcessingError $error){
            $val = 1;
            //echo $error->getMessage();
          } catch (\Conekta\ParameterValidationError $error){
            $val = 1;
            //echo $error->getMessage();
          } catch (\Conekta\Handler $error){
            $val = 1;
            //echo $error->getMessage();
          }

?>