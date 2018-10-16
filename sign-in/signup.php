<?php
// define variables and set to empty values
session_start();
require_once('cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $mail = test_input($_POST["mail"]);
 $nombre = test_input($_POST["nombre"]);
 $apellido = test_input($_POST["apellido"]);
 $pwd = test_input($_POST["pwd"]);
 $pwd2 = test_input($_POST["pwd2"]);
 $phone = test_input($_POST["phone"]);
 

 

$sql = "SELECT email FROM users where email='$mail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('¡Este usuario ya existe!')
      window.location.href='../sign-in/';
      </SCRIPT>");
} else {
    $sql = "INSERT INTO usuarios (email, nombre, apellido, pwd, telefono)
    VALUES ('$mail', '$nombre', '$apellido', '$pwd', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "hola";
        $sql2 = "SELECT email FROM usuarios WHERE email='$mail'";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            // output data of each row
            while($row2 = $result2->fetch_assoc()) {
                echo $_SESSION["email"] = $row2["email"];
                
                echo ("<SCRIPT LANGUAGE='JavaScript'>
         
              window.location.href='../dashboard/';
              </SCRIPT>");
            }
        } else{
          echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('El email y contraseña que escribiste no coinciden')
            
            </SCRIPT>");
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

 

  $conn->close();





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