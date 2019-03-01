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
								$sql2 = "SELECT titulo FROM viajes where id_viaje='".$row["id_viaje"]."'";
								$result2 = $conn->query($sql2);
								if ($result2->num_rows > 0) {
									while($row2 = $result2->fetch_assoc()) {
										echo "    <h4 class=\"card-title\"><span class=\"fas fa-plane\"></span> ".$row2["titulo"]."</h4>\n";
										echo "<b>ID Reserva: </b>".$row["id_reserva"]."";

									}
								}
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
								echo "  <input type=\"hidden\"  name=\"cambio\" value=\"".$row["id_viaje"]."\">\n";  
								echo "  <input type=\"hidden\"  name=\"reserva\" value=\"".$row["id_reserva"]."\">\n"; 
								echo "                        <a href=\"javascript:{}\" onclick=\"document.getElementById('my_form2').submit();\">\n"; 
								echo "Mis pagos <span class=\"fas fa-arrow-circle-right\"></span></a>\n";
								echo "</form>\n"; 
								echo "    <a href=\"#\" class=\"card-link\">Ver itinerario <span class=\"fas fa-arrow-circle-right\"></span></a>\n";
								/*echo "<form action=\"pay/\" id=\"my_form2\" method=\"post\">\n";
								echo "  <input type=\"hidden\"  name=\"cambio\" value=\"".$row["id_reserva"]."\">\n";  
								echo "    <br><a href=\"javascript:{}\" onclick=\"document.getElementById('my_form2').submit();\" class=\"btn btn-success btn-sm\">Abonar <span class=\"fas fa-plus-circle\"></span></a>\n";
								echo "</form>\n";*/
								echo "<p><button type=\"button\" class=\"btn btn-success btn-smy\" data-toggle=\"modal\" data-target=\"#exampleModal\">\n"; 
								echo "Abonar <span class=\"fas fa-plus-circle\"></span>\n"; 
								echo "</button></p>\n";
								echo "  </div>\n";
								echo "</div>\n";
								echo "<div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n"; 
								echo "  <div class=\"modal-dialog\" role=\"document\">\n"; 
								echo "    <div class=\"modal-content\">\n"; 
								echo "      <div class=\"modal-header\">\n"; 
								echo "        <h5 class=\"modal-title\" id=\"exampleModalLabel\">".$row["titulo"]."</h5>\n"; 
								

								echo "      </div>\n"; 
								echo "      <div class=\"modal-body\">\n"; 
								echo "<div class=\"container\">\n"; 
								echo "    <div class=\"row\">\n"; 
								echo "        <div class=\"col-sm-6\">"; 
								echo "<input type=\"radio\" name=\"data\" onclick=\"oxxo()\" id=\"oxxo\"><img src=\"oxxo.png\">\n"; 
								echo "</div>\n"; 
								echo "        <div class=\"col-sm-6\">"; 
								echo "<input type=\"radio\" name=\"data\" onclick=\"paypal()\" id=\"paypal\"/> <span class=\"fab fa-cc-paypal fa-4x\"></span>\n"; 
								echo "</div>\n"; 
								echo "        <div class=\"col-sm-10\">"; 
								echo "<input type=\"radio\" name=\"data\" onclick=\"tarjeta()\" id=\"tarjeta\" checked/> <span class=\"fab fa-cc-mastercard fa-4x\"></span> <span class=\"fab ffab fa-cc-visa fa-4x\"></span> <span class=\"fab fa-cc-amex fa-4x\"></span>\n";
								echo "</div>\n"; 
								echo "        <div class=\"col-sm-2\"></div>\n"; 
								echo "    </div>\n"; 
								echo "</div>\n";

								
								echo "      </div>\n"; 
								echo "      <div class=\"modal-footer\">\n"; 

								echo " <div id=\"Oxxo\" style=\"display:none\">\n"; 
								echo "  <button type=\"button\" class=\"btn btn-warning\">Siguiente ></button>\n"; 
								echo "</div>\n"; 
								echo " <div id=\"Tarjeta\" style=\"display:block\">\n"; 
								echo "<a href=\"#Tarjetamodal\" class=\"btn btn-info\" data-toggle=\"modal\" data-dismiss=\"modal\">Siguiente ></a>\n";
								echo "</div>\n"; 
								echo " <div id=\"Paypal\" style=\"display:none\">\n"; 
								echo "  <button type=\"button\" class=\"btn btn-primary\">Siguiente ></button>\n"; 
								echo "</div>\n"; 
								echo "\n"; 
								echo "<script type=\"text/javascript\">\n"; 
								echo "function oxxo() {\n"; 
								echo "    document.getElementById('Tarjeta').style.display = \"none\";\n"; 
								echo "    document.getElementById('Paypal').style.display = \"none\";\n"; 
								echo "    document.getElementById('Oxxo').style.display = \"block\";\n"; 
								echo "}\n"; 
								echo "function tarjeta() {\n"; 
								echo "    document.getElementById('Tarjeta').style.display = \"block\";\n"; 
								echo "    document.getElementById('Paypal').style.display = \"none\";\n"; 
								echo "    document.getElementById('Oxxo').style.display = \"none\";\n"; 
								echo "}\n"; 
								echo "function paypal() {\n"; 
								echo "    document.getElementById('Tarjeta').style.display = \"none\";\n"; 
								echo "    document.getElementById('Paypal').style.display = \"block\";\n"; 
								echo "    document.getElementById('Oxxo').style.display = \"none\";\n"; 
								echo "}\n"; 
								echo "\n"; 
								echo "</script>\n";

								//echo "        <button type=\"button\" class=\"btn btn-primary\">Save changes</button>\n"; 
								echo "      </div>\n"; 
								echo "    </div>\n"; 
								echo "  </div>\n"; 
								echo "</div>\n";


								echo "<div class=\"modal\" id=\"Tarjetamodal\">\n"; 
								echo "  <div class=\"modal-dialog modal-lg\">\n"; 
								echo "    <div class=\"modal-content\">\n"; 
								echo "\n"; 
								echo "      <!-- Modal Header -->\n"; 
								echo "      <div class=\"modal-header\">\n"; 
								echo "        <h4 class=\"modal-title\">".$row["titulo"]."</h4>\n";

								echo "        <button type=\"button\" class=\"close\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Encriptamos los datos en forma segura (TLS) y así cumplimos con los más altos estándares de seguridad online. PCI-DSS monitorea y certifica lo que hacemos.\"><span class=\"fas fa-lock\"></span></button>\n"; 
								echo "      </div>\n"; 
								echo "\n"; 
								echo "      <!-- Modal body -->\n"; 
								echo "      <div class=\"modal-body\">\n"; 
								?>
									<form action="pay.php" method="POST" id="card-form">
									  <span class="card-errors"></span>
									  <div class="container">
										    <div class="row">
										        <div class="col-sm-12 form-group text-white bg-dark rounded">
														<label>Monto:</label>
												      <div class="input-group mb-3">
														  <div class="input-group-prepend">
														    <span class="input-group-text">$</span>
														  </div>
														  <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="monto" min="3" required>
														  <div class="input-group-append">
														    <span class="input-group-text">.00</span>
														  </div>
														</div>

												      <p></p>
										        </div>
										        <?php
										        echo "<input type=\"hidden\" name=\"reserva\" value=\"".$row["id_reserva"]."\">\n";
										        ?>
										        <hr class="style5">
										        <div class="col-sm-12">
												      <label>Nombre que aparece en tarjeta: </label>
												      <input type="text" size="20" class="form-control" data-conekta="card[name]" required>
										        </div>
										        <div class="col-sm-12">
										        	  <label>Numero de tarjeta:</label>
												      <input type="text" class="form-control" size="20" data-conekta="card[number]" required>
													        </div>
										        <div class="col-sm-4">
												      <label>Fecha de expiracion:</label>
												      <?php
												      echo "      <select id=\"inputState\" class=\"form-control\" data-conekta=\"card[exp_month]\" required>\n"; 
															echo "    <option value=''>Mes</option>\n"; 
															echo "    <option value='01'>01 - Enero</option>\n"; 
															echo "    <option value='02'>02 - Febrero</option>\n"; 
															echo "    <option value='03'>03 - Marzo</option>\n"; 
															echo "    <option value='04'>04 - Abril</option>\n"; 
															echo "    <option value='05'>05 - Mayo</option>\n"; 
															echo "    <option value='06'>06 - Junio</option>\n"; 
															echo "    <option value='07'>07 - Julio</option>\n"; 
															echo "    <option value='08'>08 - Agosto</option>\n"; 
															echo "    <option value='09'>09 - Septiembre</option>\n"; 
															echo "    <option value='10'>10 - Octubre</option>\n"; 
															echo "    <option value='11'>11 - Noviembre</option>\n"; 
															echo "    <option value='12'>12 - Diciembre</option>\n"; 
															echo "</select> \n";
												      ?>
										        </div>
										        <div class="col-sm-5">
										        	<label>&nbsp;</label>
		<?php
											    	echo "      <select id=\"inputState\" class=\"form-control\" data-conekta=\"card[exp_year]\" required>\n"; 
													echo "    <option value=''>Año</option>\n";  
													echo "    <option value='2019'>2019</option>\n"; 
													echo "    <option value='2020'>2020</option>\n"; 
													echo "    <option value='2021'>2021</option>\n"; 
													echo "    <option value='2022'>2022</option>\n"; 
													echo "    <option value='2023'>2023</option>\n"; 
													echo "    <option value='2024'>2024</option>\n";
													echo "      </select>\n";
											    ?>
										        </div>
										        <div class="col-sm-3">
										        	<label>CVC:
										        	<?php
										        	echo "  <a href=\"#\" data-toggle=\"tooltip\" title=\"<img class='img-thumbnail' src='cvc.png'/>\">\n"; 
													echo "    <span class=\"fas fa-question-circle\"></span>\n"; 
													echo "  </a>\n";
										        	?>
										        	</label>
												      <input type="text" class="form-control" size="4" data-conekta="card[cvc]" required>
										        </div>
										    </div>
										</div>
									  
								<?php
								echo "      <!-- Modal footer -->\n"; 
								echo "      <div class=\"modal-footer\">\n";
								echo "<a href=\"#exampleModal\" data-toggle=\"modal\" class=\"btn btn-info\" data-dismiss=\"modal\">< Atras</a>\n"; 
								
								echo "        <input type=\"submit\" value=\"Finalizar\" class=\"btn btn-success\">\n"; 
								echo "      </div>\n"; 
								echo "</form>";
								echo "    </div>\n"; 
								echo "  </div>\n"; 
								echo "</div>\n";
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
<script type="text/javascript">
	function setTwoNumberDecimal(event) {
	    this.value = parseFloat(this.value).toFixed(2);
	}
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
