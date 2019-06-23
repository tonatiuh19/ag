<?php
// define variables and set to empty values
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';

//require_once('mailer/src/autoload.php');
session_start();
require_once('cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $mail_i = test_input($_POST["mail"]);
 $nombre = test_input($_POST["nombre"]);
 $apellido = test_input($_POST["apellido"]);
 $pwd = test_input($_POST["pwd"]);
 $pwd2 = test_input($_POST["pwd2"]);
 $phone = test_input($_POST["phone"]);




$sql = "SELECT email FROM users where email='$mail_i'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('¡Este usuario ya existe!')
      window.location.href='../sign-in/';
      </SCRIPT>");
} else {
    $sql = "INSERT INTO usuarios (email, nombre, apellido, pwd, telefono)
    VALUES ('$mail_i', '$nombre', '$apellido', '$pwd', '$phone')";

    if ($conn->query($sql) === TRUE) {
        
        $sql2 = "SELECT email FROM usuarios WHERE email='$mail_i'";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            // output data of each row
            while($row2 = $result2->fetch_assoc()) {
                //echo $_SESSION["email"] = $row2["email"];
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                   $mail->SMTPDebug = 2;                                       // Enable verbose debug output
                   // $mail->isSMTP();                                            // Set mailer to use SMTP
                    $mail->Host       = 'mail.agustirri.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'tg@agustirri.com';                     // SMTP username
                    $mail->Password   = 'tonatiuh19';                               // SMTP password
                    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
                    $mail->Port       = 469;                                    // TCP port to connect to


                    //Recipients
                    $mail->setFrom('noreply@agustirri.com', 'Bienvenido a Agustirri');
                    $mail->addAddress(''.$mail_i.'', ''.$nombre.'');     // Add a recipient
                    
                    $mail->addReplyTo('ayuda@agustirri.com', 'Information');
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');

                    // Attachments
                    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Tu cuenta ha sido creada';
                    $mail->Body    = '<p>¡Hola '.$nombre.'!</p> <p>Bienvenido a la plataforma donde tus sueños pueden hacerse realidad. Te mandamos un abrazo. Cualquier cosa estamos para servirte.</p> <p>Saludos cordiales.<br>Equipo Agustirri. <br>ayuda@agustirri.com</p>';
                    $mail->AltBody = 'Bienvenido';

                    $mail->send();
                    echo ("<SCRIPT LANGUAGE='JavaScript'>

                  window.location.href='../dashboard/';
                  </SCRIPT>");
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }


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
