<?php
// define variables and set to empty values
session_start();
require_once('../cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$precio = test_input($_POST["precio"]);
	$incluido = test_input($_POST["incluido"]);
	$fecha_ida = test_input($_POST["fecha_ida"]);
	$fecha_vuelta = test_input($_POST["fecha_vuelta"]);
	$viaje = test_input($_POST["viaje"]);

	$sql = "INSERT INTO paquetes (precio, incluido, fecha_ida, fecha_vuelta, id_viaje)
	VALUES ('".$precio."', '".$incluido."', '".$fecha_ida."','".$fecha_vuelta."','".$viaje."')";

	if ($conn->query($sql) === TRUE) {
		echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
		echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";  
		echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' />\n";
		echo "</form>\n";
		echo "<script type=\"text/javascript\">\n"; 
		echo "    document.getElementById('btnSignIn').click();\n"; 
		echo "</script>\n"; 
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();




}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>

		window.location.href='../';
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