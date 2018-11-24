<?php
// define variables and set to empty values
session_start();
require_once('cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $paquete = test_input($_POST["paquete"]);
 $reserva = test_input($_POST["reserva"]);


$sql = "UPDATE reservas SET id_paquete='".$paquete."' WHERE email='".$_SESSION['email']."' and id_reserva='".$reserva."'";

if ($conn->query($sql) === TRUE) {
   $paquete;
    echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.location.href='../dashboard/';
			    </SCRIPT>");
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();


/**/



		
}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
   
    window.location.href='../dashboard/';
    </SCRIPT>");
}



function get_random_string($length = 11){
	$pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
}



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>