<?php
// define variables and set to empty values
session_start();
require_once('cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $email = test_input($_POST["mail"]);
 $pwd = test_input($_POST["pwd"]);
 $pd2 = md5($pwd);


	$sql = "SELECT email, nombre, apellido FROM usuarios WHERE email='$email' AND pwd='$pwd'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $_SESSION["email"] =	$row["email"];

	        if (isset($_SESSION['email'])){
			echo ("<SCRIPT LANGUAGE='JavaScript'>
		   	window.location.href='../dashboard/';
		    </SCRIPT>");

		}
	    }
	} else{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
	    window.alert('El email y contraseña que escribiste no coinciden')
	    window.location.href='../sign-in/';
	    </SCRIPT>");
	}

		
}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
   
    window.location.href='../sign-in/';
    </SCRIPT>");
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>