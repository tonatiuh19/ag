<?php
// define variables and set to empty values
session_start();
require_once('../cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $nombre = test_input($_POST["nombre"]);
 $apellido = test_input($_POST["apellido"]);
 $email = test_input($_POST["email"]);
 $pwdactual = test_input($_POST["pwdactual"]);
 $pwd = test_input($_POST["pwd"]);
 $telefono = test_input($_POST["telefono"]);
 
 $sql = "SELECT pwd FROM usuarios where email='".$_SESSION['email']."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	if ($row["pwd"] != $pwdactual) {
	    		echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.alert('Contraseña actual incorrecta')
			    window.location.href='../profile/';
			    </SCRIPT>");
	    	}else{
	    		$sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', email='$email', pwd='$pwd', telefono='$telefono' WHERE email='".$_SESSION['email']."'";

				if ($conn->query($sql) === TRUE) {
				    echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.alert('Perfil actualizado satisfactoriamente')
			    window.location.href='../profile/';
			    </SCRIPT>");
				} else {
				    echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.alert('Houston tenemos problemas: Intentalo de nuevo mas tarde')
			    window.location.href='../profile/';
			    </SCRIPT>");
				}
			}
	     
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();


		
}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
   
    window.location.href='../profile/';
    </SCRIPT>");
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>