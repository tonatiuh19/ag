<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../mailer/src/Exception.php';
require '../mailer/src/PHPMailer.php';
require '../mailer/src/SMTP.php';

//require_once('mailer/src/autoload.php');
session_start();
require_once('../cn.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$reserva = $_POST["reserva"];
	$referencia = $_POST["referencia"];
	$nombre = $_POST["nombre"];
	$correo = $_POST["correo"];


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
			$mail->setFrom('noreply@agustirri.com', 'Confirmacion de Pago Agustirri: '.$reserva.'');
			$mail->addAddress(''.$correo.'', ''.$nombre.'');     // Add a recipient

			$mail->addReplyTo('ayuda@agustirri.com', 'Informacion de Pagos');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			// Attachments
			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Tu pago ha sido procesado con la siguiente referencia: '.$referencia.'';
			$mail->Body    = '<p>¡Hola '.$nombre.'!</p> <p>Tu referencia de pago es la siguiente: '.$referencia.'.</p><p>Adjunto podras encontrar tu ticket.</p> <p>Saludos cordiales.<br>Equipo Agustirri. <br>ayuda@agustirri.com</p>';
			$mail->AltBody = 'Bienvenido';

			$mail->send();

	} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Agustirri</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <!--<a class="navbar-brand" href="#"><img src="../img/logo.png" class="img-responsive" style="width:18%"></a>-->
			<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../"><img src="../../img/logo.png" class="img-responsive" style="width:18%"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


    </nav>

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3"><i class="fas fa-check-circle text-success"></i> ¡Exito!</h1><br>
          <br>Referencia de pago: <?php echo $referencia;?>
          <br>Nombre: <?php echo $nombre;?>
          <br>Correo: <?php echo $correo;?><br>
          <br>
          <p>Se han enviado detalles de pago a tu correo.</p>
          <p><a class="btn btn-primary btn-lg" href="../" role="button">&laquo; Volver</a></p>
        </div>
      </div>



    </main>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; Agustirri 2018</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">

              <li class="list-inline-item">
                <a href="https://www.facebook.com/Agustirri-448992722238113" target="_blank">
                  <i class="fab fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">

              <li class="list-inline-item">
                <a href="#">Terminos de uso</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
}
else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../';
    </SCRIPT>");
}
?>
