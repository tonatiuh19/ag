<?php
// define variables and set to empty values
session_start();
require_once('cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $paquete = test_input($_POST["paquete"]);


$view = "CREATE OR REPLACE VIEW myView AS SELECT id_viaje FROM paquetes WHERE id_paquete in (SELECT id_paquete FROM reservas WHERE email='".$_SESSION['email']."')";
if ($conn->query($view) === TRUE) {
	    if ($conn->query("SELECT * FROM myView WHERE id_viaje IN (SELECT id_viaje FROM paquetes WHERE id_paquete='".$paquete."')")->fetch_row()) {
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.alert('Ya estas registrado en este viaje')
			    window.location.href='../dashboard/';
			    </SCRIPT>");
		}else{
			do {
		    $random_string = get_random_string();
		} while ($conn->query('SELECT 1 FROM `reservas`
		             WHERE `id_reserva` = "' . $random_string . '"')->fetch_row());

		$sql = "INSERT INTO reservas (id_paquete, email, pagado, id_reserva, abonado)
			VALUES ('".$paquete."', '".$_SESSION['email']."', '0','".$random_string."','300')";

			if ($conn->query($sql) === TRUE) {
			    echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.location.href='../dashboard/';
			    </SCRIPT>");


			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();

		}


} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
}


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