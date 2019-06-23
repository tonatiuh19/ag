<?php
session_start();
if (isset($_SESSION['email'])){

}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.location.href='../sign-in/';
		</SCRIPT>");
}

?>
<!doctype html>
<html lang="en">
<head>
		<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../../../favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<title>Agustirri</title>
	<style type="text/css">
		hr.style5 {
			background-color: #fff;
			border-top: 2px dashed #8c8b8b;
		}
	</style>

	<!-- Bootstrap core CSS -->
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Custom styles for this template -->
	<link href="dashboard.css" rel="stylesheet">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>

</head>

<body>
	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../"><img src="../img/logo.png" class="img-responsive" style="width:18%"></a>

		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="fin.php">Cerrar sesion</a>
			</li>
		</ul>

	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						&nbsp;
						<li class="nav-item">
							<a class="nav-link" href="trips/">
								<span class="fas fa-suitcase">&nbsp;</span>
								Viajes <small>[beta]</small><span class="sr-only"></span>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link active" href="../dashboard/">
								<span class="fas fa-bus">&nbsp;</span>
								Mis Reservas
							</a>
						</li>

					</ul>

					<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">

						<a class="d-flex align-items-center text-muted" href="#">

						</a>
					</h6>

					<ul class="nav flex-column mb-2">
						<li class="nav-item ">
							<a class="nav-link " href="profile/">
								<span class="fas fa-user-cog">&nbsp;</span>
								Mi perfil
							</a>
						</li>

					</ul>
					<div class="fixed-bottom"><p>&nbsp;<ul class="list-inline social-buttons">
						<li class="list-inline-item">
							<a href="#">
								<i class="fab fa-twitter"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="#">
								<i class="fab fa-facebook"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="#">
								<i class="fab fa-instagram"></i>
							</a>
						</li>
					</ul></p><p>&nbsp;<span class="copyright small">Copyright &copy; Agustirri 2018</span></p></div>
				</div>
			</nav>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

				<div id="1">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2">Mis Viajes</h1>
						<div class="btn-toolbar mb-2 mb-md-0">

							<button class="btn btn-sm btn-outline-primary" id="btnClick">Buscar viaje <span class="far fa-map"></span></button>
						</div>
					</div>
					<section class="bg-light" id="portfolio">
						<?php
						require_once('cn.php');
						$mail = $_SESSION['email'];
						$sql = "SELECT reservas.abonado, reservas.pagado, paquetes.precio, paquetes.id_viaje, reservas.id_reserva, viajes.titulo FROM reservas
						INNER JOIN paquetes ON reservas.id_paquete = paquetes.id_paquete
						LEFT JOIN viajes ON paquetes.id_viaje = viajes.id_viaje
						WHERE reservas.email='".$mail."'";
						$result = $conn->query($sql);

						if ($result->num_rows >= 1) {
             //echo "<div class=\"jumbotron jumbotron-fluid\">\n";
							echo "  <div class=\"container\">\n";
							while($row = $result->fetch_assoc()) {

								echo "<div class=\"row\">\n";
								$falta = floatval($row["precio"]) - floatval($row["abonado"]);
							
								echo "<div class=\"card\">\n";
								echo "  <div class=\"card-body\">\n";
								echo "    <h4 class=\"card-title\"><span class=\"fas fa-plane\"></span> ".$row["titulo"]."</h4>\n";
								echo "<b>ID Reserva: </b>".$row["id_reserva"]."";

								if ($falta <= 0) {
									echo "    <br><p class=\"card-text\">¡A preparar maletas!</p>\n";
								}else{
									echo "    <p class=\"card-text\">Te falta: <b>$ ".number_format($falta)."</b>\n";
									echo "    <br>Abonado: <b>$ ".number_format($row["abonado"])."</b></p>\n";
								}
								echo "<form action=\"change_package/\" id=\"my_form\" method=\"post\">\n";
								echo "  <input type=\"hidden\"  name=\"cambio\" value=\"".$row["id_viaje"]."\">\n";
								echo "  <input type=\"hidden\"  name=\"reserva\" value=\"".$row["id_reserva"]."\">\n";
								echo "                        <a href=\"javascript:{}\" onclick=\"document.getElementById('my_form').submit();\">\n";
								echo "Cambiar paquete <span class=\"fas fa-arrow-circle-right\"></span></a>\n";
								echo "</form>\n";
								echo "<form action=\"payments/\" id=\"my_form2\" method=\"post\">\n";
								echo "  <input type=\"hidden\"  name=\"reserva\" value=\"".$row["id_reserva"]."\">\n";
								echo "                        <a href=\"javascript:{}\" onclick=\"document.getElementById('my_form2').submit();\">\n";
								echo "Mis pagos <span class=\"fas fa-arrow-circle-right\"></span></a>\n";
								echo "</form>\n";
								//echo "    <a href=\"#\" class=\"card-link\">Ver itinerario <span class=\"fas fa-arrow-circle-right\"></span></a>\n";
								/*echo "<form action=\"pay/\" id=\"my_form2\" method=\"post\">\n";
								echo "  <input type=\"hidden\"  name=\"cambio\" value=\"".$row["id_reserva"]."\">\n";
								echo "    <br><a href=\"javascript:{}\" onclick=\"document.getElementById('my_form2').submit();\" class=\"btn btn-success btn-sm\">Abonar <span class=\"fas fa-plus-circle\"></span></a>\n";
								echo "</form>\n";*/
								echo "<p><button type=\"button\" class=\"btn btn-success btn-smy\" data-toggle=\"modal\" data-target=\"#exampleModal".$row["id_reserva"]."\">\n";
								echo "Abonar <span class=\"fas fa-plus-circle\"></span>\n";
								echo "</button></p>\n";
								echo "  </div>\n";
								echo "</div>\n";
								echo "&nbsp;";



							}
            //echo "</div>\n";
							echo "</div>\n";
						} else {
							echo "<div class=\"jumbotron jumbotron-fluid\">\n";
							echo "  <div class=\"container\">\n";
							echo "    <h1>¡Aun no tienes viajes!</h1> \n";

							echo "<input type=\"button\" \n";
							echo "       id=\"secondaryButton\" \n";
							echo "       onclick=\"document.getElementById('btnClick').click()\" class=\"btn btn-lg btn-outline-primary\" value=\"Buscar viajes\"/>\n";
							echo "  </div>\n";
							echo "&nbsp;";
						}

						?>
					</section>


				</div>

				<div id="2" style="display:none;">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2">Buscar Viajes</h1>
						<div class="btn-toolbar mb-2 mb-md-0">

							<A class="btn btn-sm btn-outline-danger" HREF="javascript:history.go(0)"><span class="fas fa-chevron-left"></span> Regresar</A>
						</div>
					</div>

					<section class="bg-light" id="portfolio">
						<div class="container">

							<div class="row">
								<?php
								require_once('cn.php');

								$mail = $_SESSION['email'];
								$sql = "SELECT titulo, activo, id_viaje FROM viajes limit 9";
								$result = $conn->query($sql);

								if ($result->num_rows >= 1) {

									while($row = $result->fetch_assoc()) {
										if ($row["activo"]=='0') {
                          /*echo " <div class=\"col-md-4 col-sm-6 portfolio-item\">\n";
                          echo "                  <a class=\"portfolio-link\" data-toggle=\"modal\" href=\"#portfolioModal1\">\n";
                          echo "                    <div class=\"portfolio-hover\">\n";
                          echo "                      <div class=\"portfolio-hover-content\">\n";

                          echo "                      </div>\n";
                          echo "                    </div>\n";
                          echo "                    <img class=\"img-fluid\" src=\"../img/portfolio/06-thumbnail.jpg\" alt=\"\">\n";
                          echo "                  </a>\n";
                          echo "                  <div class=\"portfolio-caption\">\n";
                          echo "                    <h4>".$row["titulo"]."</h4>\n";
                          $sql2 = "SELECT min(precio) as precio FROM paquetes WHERE id_viaje='".$row["id_viaje"]."'";
                          $result2 = $conn->query($sql2);

                          if ($result2->num_rows >= 1) {

                              while($row2 = $result2->fetch_assoc()) {
                                echo "                    <p class=\"text-muted\">Desde: $".$row2["precio"]."</p>\n";

                              }
                          } else {

                          }
                          echo "                    <p class=\"text-muted\">¡Proximamente!</p>\n";
                          echo "                  </div>\n";
                          echo "                </div>\n";*/
                      }else{
                      	echo " <div class=\"col-md-4 col-sm-6 portfolio-item\">\n";
                      	echo "                  <a class=\"portfolio-link\" data-toggle=\"modal\" href=\"#portfolioModal1\">\n";
                      	echo "                    <div class=\"portfolio-hover\">\n";
                      	echo "                      <div class=\"portfolio-hover-content\">\n";

                      	echo "                      </div>\n";
                      	echo "                    </div>\n";
                      	if ($row["id_viaje"] == '2') {
                      		echo "                    <img class=\"img-fluid\" src=\"../img/portfolio/06-thumbnail.jpg\" alt=\"\">\n";
                      	}else{
                      		echo "                    <img class=\"img-fluid\" src=\"../img/portfolio/02-thumbnail.jpg\" alt=\"\">\n";
                      	}

                      	echo "                  </a>\n";
                      	echo "                  <div class=\"portfolio-caption\">\n";
                      	echo "                    <h4>".$row["titulo"]."</h4>\n";
                      	$sql2 = "SELECT min(precio) as precio FROM paquetes WHERE id_viaje='".$row["id_viaje"]."'";
                      	$result2 = $conn->query($sql2);

                      	if ($result2->num_rows >= 1) {

                      		while($row2 = $result2->fetch_assoc()) {
                      			echo "                    <p class=\"text-muted\">Desde: $".number_format($row2["precio"])."</p>\n";

                      		}
                      	} else {

                      	}
                      	echo "<form action=\"new_reservation/\" method=\"post\">\n";
                      	echo "  <input type=\"hidden\"  name=\"viajesito\" value=\"".$row["id_viaje"]."\">\n";
                      	echo "<button class=\"btn btn-sm btn-outline-primary\" type=\"submit\">Ver paquetes <span class=\"fas fa-magic\"></span></button>\n";
                      	echo "</form>\n";

                      	echo "                  </div>\n";
                      	echo "                </div>\n";
                      }



                  }
              } else {
              	echo "<div class=\"jumbotron jumbotron-fluid\">\n";
              	echo "  <div class=\"container\">\n";
              	echo "    <h1>¡Aun no tienes viajes!</h1> \n";

              	echo "<input type=\"button\" \n";
              	echo "       id=\"secondaryButton\" \n";
              	echo "       onclick=\"document.getElementById('btnClick').click()\" class=\"btn btn-lg btn-outline-primary\" value=\"Buscar viajes\"/>\n";
              	echo "  </div>\n";
              	echo "</div>\n";
              }

              ?>

          </div>
      </div>
  </section>
</div>


</main>
</div>
</div>
<?php
$sqld = "SELECT reservas.abonado, reservas.pagado, paquetes.precio, paquetes.id_viaje, reservas.id_reserva, viajes.titulo FROM reservas
						INNER JOIN paquetes ON reservas.id_paquete = paquetes.id_paquete
						LEFT JOIN viajes ON paquetes.id_viaje = viajes.id_viaje
						WHERE reservas.email='".$mail."'";
$resultd = $conn->query($sqld);

if ($resultd->num_rows > 0) {
    // output data of each row
    while($rowd = $resultd->fetch_assoc()) {
    	echo "<div class=\"modal fade\" id=\"exampleModal".$rowd["id_reserva"]."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n";
        ?>
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $rowd["titulo"];?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Elige tu metodo de pago:</p>
                        <?php echo "  <input type=\"hidden\" id=\"titulo".$rowd["id_reserva"]."\" value=\"".$rowd["titulo"]."\">\n";
                        echo "  <input type=\"hidden\" id=\"reserva".$rowd["id_reserva"]."\" value=\"".$rowd["id_reserva"]."\">\n";
                         echo "<button type=\"button\" class=\"btn btn-lg px-5 btn-light\" id=\"btnSave".$rowd["id_reserva"]."\" data-toggle=\"modal\" data-target=\"#Tarjetamodal\">\n";
                        echo "<script type=\"text/javascript\">\n";
						echo "  $(function() {\n";
						echo "    $('#btnSave".$rowd["id_reserva"]."').click(function() {\n";
						echo "      var value = $('#titulo".$rowd["id_reserva"]."').val();\n";
						echo "      var value2 = $('#reserva".$rowd["id_reserva"]."').val();\n";
						echo "      $('#cambioH1').html(value);\n";
						echo "      $('#id_reserva_modal').val(value2);\n";
						echo "    });\n";
						echo "  });\n";
						echo "</script>\n"; ?>
                                <img src="img/tarjetas.png" height="60" alt="USA flag">
                            </button>&nbsp;
                            <?php echo "<button type=\"button\" id=\"btnSave2".$rowd["id_reserva"]."\" class=\"btn btn-lg px-5 btn-light\" data-toggle=\"modal\" data-target=\"#Oxxomodal\">\n";
                             echo "<script type=\"text/javascript\">\n";
						echo "  $(function() {\n";
						echo "    $('#btnSave2".$rowd["id_reserva"]."').click(function() {\n";
						echo "      var value = $('#titulo".$rowd["id_reserva"]."').val();\n";
						echo "      var value2 = $('#reserva".$rowd["id_reserva"]."').val();\n";
						echo "      $('#cambioH2').html(value);\n";
						echo "      $('#id_reserva_modal2').val(value2);\n";
						echo "    });\n";
						echo "  });\n";
						echo "</script>\n";
                            ?>
                                <img src="img/oxxo.png" height="60" alt="USA flag">
                            </button>
                      </div>
                    </div>
                  </div>
                </div>
                <?php }

} else {
    echo "0 results";
}?>

    	<div class="modal fade" id="Tarjetamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="cambioH1">Pago con Tarjeta</h5>

		          <button type="button" class="btn btn-link text-dark" data-toggle="tooltip" data-placement="left" title="Estamos respaldados por un equipo de expertos para combatir fraudes. Contamos con las
soluciones más avanzadas y el mayor radar de detección de malversaciones a nivel mundial.">
					  <i class="fas fa-lock"></i>
					</button>

		      </div>
		      <div class="modal-body">
		        <form action="pay.php" method="POST" id="card-form">
		          <div class="container text-light bg-dark">
			          <div class="form-group">
					    <label for="exampleInputEmail1" class="col-form-label-lg">Monto:</label>
					    <input type="number" placeholder="$ 500" class="form-control form-control-lg" id="price" name="monto" required><br>
					  </div>
				  </div>
				  <span class="card-errors text-danger"></span><br>

				 <div class="form-group">
				    <label for="exampleInputEmail1">Nombre que aparece en tarjeta: <button type="button" class="btn btn-link btn-sm" data-toggle="tooltip" data-html="true" title="<img src=&quot;tarjeta_nombre.png&quot;>"><i class="fas fa-question-circle"></i></button></label>
				    <input type="hidden" name="reserva" id="id_reserva_modal" value="">
				    <input type="text" class="form-control" data-conekta="card[name]" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Numero de tarjeta: <button type="button" class="btn btn-link btn-sm" data-toggle="tooltip" data-html="true" title="<img src=&quot;tarjeta_numero.png&quot;>"><i class="fas fa-question-circle"></i></button></label>
				    <input type="number" class="form-control" size="20" data-conekta="card[number]" required>
				  </div>
				  <div class="form-row">
				    <div class="col">
				      <label for="inputState">Fecha de expiracion: <button type="button" class="btn btn-link btn-sm" data-toggle="tooltip" data-html="true" title="<img src=&quot;tarjeta_fecha.png&quot;>"><i class="fas fa-question-circle"></i></button></label>
				      <select id="inputState" class="form-control" data-conekta="card[exp_month]" required>
				        <option selected disabled>Mes</option>
				        <option value="01">Enero - 01</option>
				        <option value="02">Febrero - 02</option>
				        <option value="03">Marzo - 03</option>
				        <option value="04">Abril - 04</option>
				        <option value="05">Mayo - 05</option>
				        <option value="06">Junio - 06</option>
				        <option value="07">Julio - 07</option>
				        <option value="08">Agosto - 08</option>
				        <option value="09">Septiembre - 09</option>
				        <option value="10">Octubre - 10</option>
				        <option value="11">Noviembre - 11</option>
				        <option value="12">Diciembre - 12</option>
				      </select>
				    </div>
				    <div class="col">
				      <label for="inputState"><button class="btn btn-link btn-sm">&nbsp;</button></label>
				      <select id="inputState" class="form-control" data-conekta="card[exp_year]" required>
				        <option selected disabled>Año</option>
				        <option value="2019">2019</option>
				        <option value="2020">2020</option>
				        <option value="2021">2021</option>
				        <option value="2022">2022</option>
				        <option value="2023">2023</option>
				        <option value="2024">2024</option>
				        <option value="2025">2025</option>
				        <option value="2026">2026</option>
				        <option value="2027">2027</option>
				        <option value="2028">2028</option>
				      </select>
				    </div>
				    <div class="col">
				    	<label>CVC: <button type="button" class="btn btn-link btn-sm" data-toggle="tooltip" data-html="true" title="<img src=&quot;tarjeta_atras_cvc.png&quot;>"><i class="fas fa-question-circle"></i></button></label>
				      <input type="text" class="form-control" size="4" data-conekta="card[cvc]" required>
				    </div>
				  </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Atras</button>
		        <button type="submit" class="btn btn-success">Finalizar</button>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>


    	<div class="modal fade" id="Oxxomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="cambioH2">Oxxo Pay</h5>

		          <button type="button" class="btn btn-link text-dark" data-toggle="tooltip" data-placement="left" title="Estamos respaldados por un equipo de expertos para combatir fraudes. Contamos con las
soluciones más avanzadas y el mayor radar de detección de malversaciones a nivel mundial.">
					  <i class="fas fa-lock"></i>
					</button>

		      </div>
		      <div class="modal-body">
		        <form action="oxxo_pay/" method="POST" >
		          <div class="container text-light bg-dark">
			          <div class="form-group">
					    <label for="exampleInputEmail1" class="col-form-label-lg">Monto:</label>
					    <input type="number" placeholder="$ 500" class="form-control form-control-lg" id="price" name="monto" required><br>
					    <input type="hidden" name="reserva" id="id_reserva_modal2" value="">
					  </div>
				  </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Atras</button>
		        <button type="submit" class="btn btn-success">Generar Ticket</button>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>


<script type="text/javascript">
	function setTwoNumberDecimal(event) {
	    this.value = parseFloat(this.value).toFixed(2);
	}
	$('#price').html(Math.floor($('.#price').html()));
</script>
<script type="text/javascript">
	$(function() {
		$('[data-toggle="tooltip"]').tooltip({
			html: true
		});
	});
</script>
<script type="text/javascript">
  Conekta.setPublicKey('key_Lc3mLsmPDnNJsv5zYhzAkjA');


  var conektaSuccessResponseHandler = function(token) {
    var $form = $("#card-form");
    //Add the token_id in the form
     $form.append($('<input type="hidden" name="conektaTokenId" id="conektaTokenId">').val(token.id));
    $form.get(0).submit(); //Submit
  };

  var conektaErrorResponseHandler = function(response) {
    var $form = $("#card-form");
    $form.find(".card-errors").text(response.message_to_purchaser);
    $form.find("button").prop("disabled", false);

  };

  //jQuery generate the token on submit.
  $(function () {
    $("#card-form").submit(function(event) {
      var $form = $(this);
      // Prevents double clic
      $form.find("button").prop("disabled", true);
      Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);

      return false;
    });
  });
</script>
<script type="text/javascript">
	$('#btnClick').on('click',function(){
		if($('#1').css('display')!='none'){
			$('#2').show().siblings('div').hide();
		}else if($('#2').css('display')!='none'){
			$('#1').show().siblings('div').hide();
		}
	});

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
    <!-- Bootstrap core JavaScript
    	================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    	<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    	<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>




    </body>
    </html>
