<?php
// define variables and set to empty values
session_start();
require_once('../cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$cupon = test_input($_POST["cupon"]);
	$viaje = test_input($_POST["viaje"]);

	$sql = "DELETE FROM promo WHERE id_promo='".$cupon."'";

	if ($conn->query($sql) === TRUE) {
		echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
		echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";  
		echo "<input type='submit' name='btnSignIn' value='' id='btnSignIn' />\n";
		echo "</form>\n";
		echo "<script type=\"text/javascript\">\n"; 
		echo "    document.getElementById('btnSignIn').click();\n"; 
		echo "</script>\n"; 
	} else {
		echo "Error updating record: " . $conn->error;
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