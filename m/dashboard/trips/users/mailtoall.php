<?php
// define variables and set to empty values
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
require_once('../cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$good = array();
	$bad = array();
	$message = test_input($_POST["message"]);
	$titulo = test_input($_POST["titulo"]);
	$email_u = test_input($_POST["email_u"]);
	$email_c = $_POST['result'];
	$name_c = test_input($_POST["name_c"]);
	$viaje = test_input($_POST["viaje"]);

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	if (is_array($values) || is_object($values)){
		foreach ($email_c as $key) {
			try {
					//Server settings
					//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'mx58.hostgator.mx';  // Specify main and backup SMTP servers
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'correos.c@agustirri.com';                 // SMTP username
					$mail->Password = 'correos2018';                           // SMTP password
					$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 587;                                    // TCP port to connect to

					//Recipients
					$mail->setFrom('noreply@agustirri.com', 'Agustirri Bot');
					$mail->addAddress(''.$key.'', ''.$name_c.'');     // Add a recipient
					$mail->addReplyTo(''.$email_u.'', ''.$email_u.'');

					//Attachments
					if (isset($_FILES['uploaded_file']) &&
						$_FILES['uploaded_file']['error'] == UPLOAD_ERR_OK) {
						$mail->AddAttachment($_FILES['uploaded_file']['tmp_name'],
																 $_FILES['uploaded_file']['name']);
				}

					//Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'IMPORTANTE: '.$titulo.'';
					$mail->Body    = 'Hola <b>'.$name_c.'</b>, <p>'.$message.'</p> Saludos cordiales. <br>Creador de tu aventura.';
					$mail->AltBody = ''.$message.'';


					$mail->send();
					echo $key;
					array_push($good, $key);
			} catch (Exception $e) {
					array_push($bad, $key);
			}
		}
	}

	$mail = new PHPMailer(true);                               // Passing `true` enables exceptions


	echo "<!doctype html>\n";
	echo "<html lang=\"en\">\n";
	echo "<head>\n";
	echo "	<meta charset=\"utf-8\">\n";
	echo "	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\n";
	echo "	<meta name=\"description\" content=\"\">\n";
	echo "	<meta name=\"author\" content=\"\">\n";
	echo "	<link rel=\"icon\" href=\"../../../../favicon.ico\">\n";
	echo "	<title>Agustirri</title>\n";
	echo "	<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\">\n";
	echo "	<link href=\"cover.css\" rel=\"stylesheet\">\n";
	echo "</head>\n";
	echo "<body class=\"text-center\">\n";
	echo "	<div class=\"cover-container d-flex h-100 p-3 mx-auto flex-column\">\n";
	echo "		<header class=\"masthead mb-auto\">\n";
	echo "			<div class=\"inner\">\n";
	//echo "				<h3 class=\"masthead-brand\"><img src=\"https://www.agustirri.com/img/logo.png\"></h3>\n";
	echo "			</div>\n";
	echo "		</header>\n";
	echo "		<main role=\"main\" class=\"inner cover\">\n";
	echo "			<h1 class=\"cover-heading\">Mensaje general.</h1>\n";
	echo "			<p class=\"lead\"><h5>Mensajes enviados Satisfactoriamente:</h5></p>\n";
	foreach ($good as $value1) {
		echo "			<p class=\"lead\">".$value1."</p>\n";
	}
	echo "			<p class=\"lead\"><h5>Mensajes no enviados:</h5></p>\n";
	foreach ($bad as $value2) {
		echo "			<p class=\"lead\">".$value2."</p>\n";
	}
	echo "			<p class=\"lead\">\n";
	echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
	echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";
	echo "<input type='submit' name='btnSignIn' class=\"btn btn-lg btn-secondary\" value='< Volver' id='btnSignIn' />\n";
	echo "</form>\n";
	echo "			</p>\n";
	echo "		</main>\n";
	echo "		<footer class=\"mastfoot mt-auto\"> </footer> </div>\n";
	echo "    	<script src=\"https://code.jquery.com/jquery-3.2.1.slim.min.js\" integrity=\"sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN\" crossorigin=\"anonymous\"></script>\n";
	echo "    	<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js\" integrity=\"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q\" crossorigin=\"anonymous\"></script>\n";
	echo "    	<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\" integrity=\"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl\" crossorigin=\"anonymous\"></script>\n";
	echo "</body>\n";
	echo "</html>\n";
	echo "\n";



}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>

		window.location.href='../';
		</SCRIPT>");
}


function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


?>
