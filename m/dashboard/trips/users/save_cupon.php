<?php
// define variables and set to empty values
session_start();
require_once('../cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = test_input($_POST["name"]);
	$viaje = test_input($_POST["viaje"]);
	$fecha_ap = test_input($_POST["fecha_ap"]);
	$fecha_exp = test_input($_POST["fecha_exp"]);
	$descuento = test_input($_POST["descuento"]);


	$sql2 = "SELECT descuento FROM promo where id_promo='".$name."'";
	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {
	    echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
		echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";  
		echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' style=\"display: none;\"/>\n";
		echo "</form>\n";
	    echo ("<SCRIPT LANGUAGE='JavaScript'>
	    window.alert('El nombre del cupon ya existe.')
	    document.getElementById('btnSignIn').click();
	    </SCRIPT>");
	} else {
		$sql = "INSERT INTO promo (id_viaje, descuento, fecha_ap, fecha_exp, id_promo)
		VALUES ('".$viaje."', '".$descuento."', '".$fecha_ap."', '".$fecha_exp."', '".$name."')";
		if ($conn->query($sql) === TRUE) {
		    echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
			echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";  
			echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' style=\"display: none;\"/>\n";
			echo "</form>\n";
			echo "<script type=\"text/javascript\">\n"; 
			echo "    document.getElementById('btnSignIn').click();\n"; 
			echo "</script>\n"; 
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
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