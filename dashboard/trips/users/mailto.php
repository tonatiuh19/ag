<?php
// define variables and set to empty values
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
require_once('../cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$message = test_input($_POST["message"]);
	$titulo = test_input($_POST["titulo"]);
	$email_u = test_input($_POST["email_u"]);
	$email_c = test_input($_POST["email_c"]);
	$name_c = test_input($_POST["name_c"]);
	$viaje = test_input($_POST["viaje"]);

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
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
	    $mail->addAddress(''.$email_c.'', ''.$name_c.'');     // Add a recipient
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
			echo "<form action=\"../users/\" id=\"my_form\" method=\"post\">\n";
			echo "  <input type=\"hidden\" name=\"viaje\" value=\"".$viaje."\">\n";
			echo "<input type='submit' name='btnSignIn' value='Sign In' id='btnSignIn' />\n";
			echo "</form>\n";
			echo "<script type=\"text/javascript\">\n";
			echo "    document.getElementById('btnSignIn').click();\n";
			echo "    alert('Mensaje enviado.');\n";
			echo "</script>\n";
	} catch (Exception $e) {
	    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}





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
