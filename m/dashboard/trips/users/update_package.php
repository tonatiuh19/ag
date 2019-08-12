<?php
// define variables and set to empty values
session_start();
require_once('../cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$paquete = $_POST["id_paquete"];
	$precio = $_POST["precio"];
	$incluido = $_POST["incluido"];
	$fecha_ida = $_POST["fecha_ida"];
	$fecha_vuelta = $_POST["fecha_vuelta"];
	$viaje = $_POST["viaje"];

	
	for ($i=0; $i < count($paquete);) { 
		//echo $precio[$i];
		$sql = "UPDATE paquetes SET precio='".$precio[$i]."',incluido='".$incluido[$i]."',fecha_ida='".$fecha_ida[$i]."',fecha_vuelta='".$fecha_vuelta[$i]."' WHERE id_paquete=".$paquete[$i]."";

		if ($conn->query($sql) === TRUE) {
			$i++;
		} else {
			echo "Error updating record: " . $conn->error;
		}

		if ($i == count($paquete)) {
			echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
			echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";  
			echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' />\n";
			echo "</form>\n";
			echo "<script type=\"text/javascript\">\n"; 
			echo "    document.getElementById('btnSignIn').click();\n"; 
			echo "</script>\n"; 
		}
	}
	/**/



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