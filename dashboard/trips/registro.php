<?php
// define variables and set to empty values
session_start();
require_once('../cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $titulo = test_input($_POST["titulo"]);
 $origen = test_input($_POST["origen"]);
 $destino = test_input($_POST["destino"]);
 $count = test_input($_POST["Count"]);
 $ida1 = test_input($_POST["ida1"]);
 $regreso1 = test_input($_POST["regreso1"]);
 $detalles1 = test_input($_POST["detalles1"]);
 $precio1 = test_input($_POST["precio1"]);
 $ida2 = test_input($_POST["ida2"]);
 $regreso2 = test_input($_POST["regreso2"]);
 $detalles2 = test_input($_POST["detalles2"]);
 $precio2 = test_input($_POST["precio2"]);
 $ida3 = test_input($_POST["ida3"]);
 $regreso3 = test_input($_POST["regreso3"]);
 $detalles3 = test_input($_POST["detalles3"]);
 $precio3 = test_input($_POST["precio3"]);
 $ida4 = test_input($_POST["ida4"]);
 $regreso4 = test_input($_POST["regreso4"]);
 $detalles4 = test_input($_POST["detalles4"]);
 $precio4 = test_input($_POST["precio4"]);
 $moneda = 'MXN';

$sql = "INSERT INTO viajes (titulo, origen, destino, email_user)
VALUES ('".$titulo."', '".$origen."', '".$destino."','".$_SESSION['email']."')";

if ($conn->query($sql) === TRUE) {

	$sql2 = "SELECT max(id_viaje) as id_viaje FROM viajes where destino='".$destino."' and email_user='".$_SESSION['email']."' ";
	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {
	    // output data of each row
	    while($row2 = $result2->fetch_assoc()) {
	        if ($count == '1') {
	        	$sql3 = "INSERT INTO paquetes (id_viaje, fecha_ida, fecha_regreso, detalles, precio, moneda)
				VALUES ('".$row2["id_viaje"]."', '".$ida1."', '".$regreso1."','".$detalles1."','".$precio1."','".$moneda."')";

				if ($conn->query($sql3) === TRUE) {
				    echo ("<SCRIPT LANGUAGE='JavaScript'>
				   
				    window.location.href='../trips/';
				    </SCRIPT>");
				} else {
				    echo ("<SCRIPT LANGUAGE='JavaScript'>
				    window.alert('Por favor intentalo de nuevo mas tarde. ayuda@agustirri.com')
				    window.location.href='../trips/';
				    </SCRIPT>");
				}
	        }elseif ($count == '2') {
	        	$sql3 = "INSERT INTO paquetes (id_viaje, fecha_ida, fecha_regreso, detalles, precio, moneda)
				VALUES ('".$row2["id_viaje"]."', '".$ida1."', '".$regreso1."','".$detalles1."','".$precio1."','".$moneda."'), ('".$row2["id_viaje"]."', '".$ida2."', '".$regreso2."','".$detalles2."','".$precio2."','".$moneda."')";

				if ($conn->query($sql3) === TRUE) {
				    echo ("<SCRIPT LANGUAGE='JavaScript'>
				   
				    window.location.href='../trips/';
				    </SCRIPT>");
				} else {
				    echo ("<SCRIPT LANGUAGE='JavaScript'>
				    window.alert('Por favor intentalo de nuevo mas tarde. ayuda@agustirri.com')
				    window.location.href='../trips/';
				    </SCRIPT>");
				}
	        }elseif($count == '3'){
				$sql3 = "INSERT INTO paquetes (id_viaje, fecha_ida, fecha_regreso, detalles, precio, moneda)
				VALUES ('".$row2["id_viaje"]."', '".$ida1."', '".$regreso1."','".$detalles1."','".$precio1."','".$moneda."'), ('".$row2["id_viaje"]."', '".$ida2."', '".$regreso2."','".$detalles2."','".$precio2."','".$moneda."'), ('".$row2["id_viaje"]."', '".$ida3."', '".$regreso3."','".$detalles3."','".$precio3."','".$moneda."')";

				if ($conn->query($sql3) === TRUE) {
				    echo ("<SCRIPT LANGUAGE='JavaScript'>
				   
				    window.location.href='../trips/';
				    </SCRIPT>");
				} else {
				    echo ("<SCRIPT LANGUAGE='JavaScript'>
				    window.alert('Por favor intentalo de nuevo mas tarde. ayuda@agustirri.com')
				    window.location.href='../trips/';
				    </SCRIPT>");
				}
	        }elseif ($count == '4') {
	        	$sql3 = "INSERT INTO paquetes (id_viaje, fecha_ida, fecha_regreso, detalles, precio, moneda)
				VALUES ('".$row2["id_viaje"]."', '".$ida1."', '".$regreso1."','".$detalles1."','".$precio1."','".$moneda."'), ('".$row2["id_viaje"]."', '".$ida2."', '".$regreso2."','".$detalles2."','".$precio2."','".$moneda."'), ('".$row2["id_viaje"]."', '".$ida3."', '".$regreso3."','".$detalles3."','".$precio3."','".$moneda."'), ('".$row2["id_viaje"]."', '".$ida4."', '".$regreso4."','".$detalles4."','".$precio4."','".$moneda."')";

				if ($conn->query($sql3) === TRUE) {
				    echo ("<SCRIPT LANGUAGE='JavaScript'>
				   
				    window.location.href='../trips/';
				    </SCRIPT>");
				} else {
				    echo ("<SCRIPT LANGUAGE='JavaScript'>
				    window.alert('Por favor intentalo de nuevo mas tarde. ayuda@agustirri.com')
				    window.location.href='../trips/';
				    </SCRIPT>");
				}
	        }
	    }
	} else {
	    echo "0 results";
	}
    
} else {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
	    window.alert('Por favor intentalo de nuevo mas tarde. ayuda@agustirri.com')
	    window.location.href='../trips/';
	    </SCRIPT>");
}

$conn->close();
 

		
}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
   
    window.location.href='../trips/';
    </SCRIPT>");
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>