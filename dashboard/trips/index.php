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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <title>Agustirri</title>

    <!-- Bootstrap core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../../"><img src="../../img/logo.png" class="img-responsive" style="width:18%"></a>
      
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
                <a class="nav-link active" href="../trips/">
                  <span class="fas fa-suitcase">&nbsp;</span>
                  Viajes <small class="text-muted">[beta]</small><span class="sr-only"></span>
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="../">
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
              <li class="nav-item">
                <a class="nav-link" href="../profile">
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
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
          <?php
          require_once('../cn.php');
          
          $sql = "SELECT activo, titulo, id_viaje FROM viajes where email_user='".$_SESSION['email']."'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
               echo "<h1 class=\"h2\">Tus viajes</h1>\n"; 
                  echo "            <div class=\"btn-toolbar mb-2 mb-md-0\">\n"; 
                  echo "             \n"; 
                  echo "\n"; 
                  echo "              <button class=\"btn btn-sm btn-outline-info\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Tooltip on bottom\" type=\"button\">\n"; 
                  echo "                \n"; 
                  echo "                <span class=\"fas fa-question-circle\"></span>\n"; 
                  echo "              </button>\n"; 
                  echo "\n"; 
                  echo "            </div>\n"; 
                  echo "          </div>\n";
                  echo "  <section class=\"bg-light\" id=\"portfolio\">\n"; 
                  echo "            <div class=\"container\">\n"; 
                  echo "              \n"; 
                  echo "              <div class=\"row\">\n";
              while($row = $result->fetch_assoc()) {
                 
                  if ($row["activo"]=='0') {
                          echo " <div class=\"col-md-4 col-sm-6 portfolio-item\">\n"; 
                          echo "                  <a class=\"portfolio-link\" data-toggle=\"modal\" href=\"#portfolioModal1\">\n"; 
                          echo "                    <div class=\"portfolio-hover\">\n"; 
                          echo "                      <div class=\"portfolio-hover-content\">\n"; 
                          
                          echo "                      </div>\n"; 
                          echo "                    </div>\n"; 
                          echo "                    <img class=\"img-fluid\" src=\"https://d30y9cdsu7xlg0.cloudfront.net/png/6446-200.png\" alt=\"\">\n"; 
                          echo "                  </a>\n"; 
                          echo "                  <div class=\"portfolio-caption\">\n"; 
                          echo "                    <h4>".$row["titulo"]."</h4>\n";
                          $sql2 = "SELECT count(id_paquete) as paquete FROM paquetes WHERE id_viaje='".$row["id_viaje"]."'";
                          $result2 = $conn->query($sql2);

                          if ($result2->num_rows >= 1) {
                            
                              while($row2 = $result2->fetch_assoc()) {
                                echo "                    <p class=\"text-muted\">Paquetes: ".$row2["paquete"]."</p>\n"; 
                               
                              }
                          } else {
                             
                          }
                          echo "                    <p class=\"text-muted\">Viaje inactivo. En espera de activacion.</p>\n";
                          echo "                  </div>\n"; 
                          echo "                </div>\n";
                  }else{
                          echo " <div class=\"col-md-4 col-sm-6 portfolio-item\">\n"; 
                          echo "                  <a class=\"portfolio-link\" data-toggle=\"modal\" href=\"#portfolioModal1\">\n"; 
                          echo "                    <div class=\"portfolio-hover\">\n"; 
                          echo "                      <div class=\"portfolio-hover-content\">\n"; 
                         
                          echo "                      </div>\n"; 
                          echo "                    </div>\n"; 
                          echo "                    <img class=\"img-fluid\" src=\"../img/portfolio/02-thumbnail.jpg\" alt=\"\">\n"; 
                          echo "                  </a>\n"; 
                          echo "                  <div class=\"portfolio-caption\">\n"; 
                          echo "                    <h4>".$row["titulo"]."</h4>\n";
                          $sql2 = "SELECT count(id_paquete) as paquete FROM paquetes WHERE id_viaje='".$row["id_viaje"]."'";
                          $result2 = $conn->query($sql2);

                          if ($result2->num_rows >= 1) {
                            
                              while($row2 = $result2->fetch_assoc()) {
                                echo "                    <p class=\"text-muted\">Paquetes: ".$row2["paquete"]."</p>\n"; 
                               
                              }
                          } else {
                             
                          }
                          
                          echo "                  </div>\n"; 
                          echo "                </div>\n";
                  }

              }
                echo "</div>\n"; 
echo "            </div>\n"; 
echo "          </section>\n";
          } else {
              echo "<h1 class=\"h2\">Organiza tu viaje</h1>\n"; 
              echo "            <div class=\"btn-toolbar mb-2 mb-md-0\">\n"; 
              echo "             \n"; 
              echo "\n"; 
              echo "              <button class=\"btn btn-sm btn-outline-info\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Tooltip on bottom\" type=\"button\">\n"; 
              echo "                \n"; 
              echo "                <span class=\"fas fa-question-circle\"></span>\n"; 
              echo "              </button>\n"; 
              echo "\n"; 
              echo "            </div>\n"; 
              echo "          </div>\n";
              echo "<!--Registrostart-->\n"; 
              echo "            <div class=\"container\">\n"; 
              echo "              <div class=\"text-center\">\n"; 
              echo "                <img class=\"d-block mx-auto mb-4\" src=\"https://getbootstrap.com/assets/brand/bootstrap-solid.svg\" alt=\"\" width=\"72\" height=\"72\">\n"; 
              echo "              <h2>Registra tu viaje</h2>\n"; 
              echo "                <p class=\"lead\">Antes de publicar un viaje al publico en general, envianos la informacion correspondiente para analizarlo y poderlo aprobar.</p>\n"; 
              echo "              </div>\n"; 
              echo "\n"; 
              echo "              <div class=\"row\">\n"; 
              echo "                \n"; 
              echo "                <div class=\"col-md-12 order-md-1\">\n"; 
              echo "                 \n"; 
              echo "                  <form class=\"needs-validation\" method=\"post\" action=\"registro.php\" novalidate>\n"; 
              echo "                    <div class=\"row\">\n"; 
              echo "                      <div class=\"col-md-12 mb-3\">\n"; 
              echo "                        <label for=\"firstName\">Titulo del viaje</label>\n"; 
              echo "                        <input type=\"text\" class=\"form-control\" id=\"firstName\" placeholder=\"\" value=\"\" name=\"titulo\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¡Recuerda que la primer impresion es la que cuenta!\n"; 
              echo "                        </div>\n"; 
              echo "                      </div>\n"; 
              echo "                      \n"; 
              echo "                    </div>\n"; 
              echo "\n"; 
              echo "                    \n"; 
              echo "\n"; 
              echo "                  \n"; 
              echo "\n"; 
              echo "                    <div class=\"mb-3\">\n"; 
              echo "                      <label for=\"address\">Origen (es)</label>\n"; 
              echo "                      <input type=\"text\" class=\"form-control\" id=\"address\" placeholder=\"Lagos de Moreno, Guadalajara\" name=\"origen\" required>\n"; 
              echo "                      <div class=\"invalid-feedback\">\n"; 
              echo "                        ¡Es importante el origen!\n"; 
              echo "                      </div>\n"; 
              echo "                    </div>\n"; 
              echo "\n"; 
              echo "                    <div class=\"mb-3\">\n"; 
              echo "                      <label for=\"address2\">Destino (s)</label>\n"; 
              echo "                      <input type=\"text\" class=\"form-control\" id=\"address\" placeholder=\"Miami, Las Vegas\" name=\"destino\" required>\n"; 
              echo "                      <div class=\"invalid-feedback\">\n"; 
              echo "                        ¡Es importante el destino!\n"; 
              echo "                      </div>\n"; 
              echo "                    </div>\n"; 
              echo "\n"; 
              echo "                    <div class=\"row\">\n"; 
              echo "                      <div class=\"col-md-5 mb-3\">\n"; 
              echo "                        <label for=\"state\">¿Cuantos paquetes contiene este viaje?</label>\n"; 
              echo "                        <select class=\"DropdownClass custom-select d-block w-100\" name=\"Count\" id=\"selectModelNumber\">\n"; 
              echo "                            <option value=\"1\">1</option>\n"; 
              echo "                            <option value=\"2\">2</option>\n"; 
              echo "                            <option value=\"3\">3</option>\n"; 
              echo "                            <option value=\"4\" selected>4</option>\n"; 
              echo "                        </select>\n"; 
              echo "                      </div>\n"; 
              echo "                      \n"; 
              echo "                    </div>\n"; 
              echo "                    <div class=\"row\">\n"; 
              echo "                      <div class=\"CommonAttribute DivElement1 col-md-6 mb-3 portfolio-item\"><br>\n"; 
              echo "                        <h4>Paquete 1</h4>\n"; 
              echo "                        <label for=\"ida\">Fecha de Ida</label>\n"; 
              echo "                        <input type=\"date\" value=\"2018-08-19\" class=\"form-control\" id=\"ida\" name=\"ida1\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que fecha es la ida?\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"regreso\">Fecha de Regreso</label>\n"; 
              echo "                        <input type=\"date\" value=\"2018-08-29\" class=\"form-control\" id=\"regreso\" name=\"regreso1\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que fecha es el regreso?\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"detalles\">Detalles</label>\n"; 
              echo "                        <textarea  class=\"form-control\" id=\"detalles\" rows=\"3\" value=\"\" name=\"detalles1\" required>¿Que incluye?</textarea>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          Indica que incluye este paquete.\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"precio\">Precio</label>\n"; 
              echo "                        <input type=\"text\" class=\"form-control\" id=\"precio\" placeholder=\"\" value=\"0\" name=\"precio1\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que precio tiene?\n"; 
              echo "                        </div>\n"; 
              echo "                        <br>\n"; 
              echo "                      </div>\n"; 
              echo "                      <div class=\"CommonAttribute DivElement1 col-md-6 mb-3 portfolio-item \"><br>\n"; 
              echo "                        <h4>Paquete 2</h4>\n"; 
              echo "                        <label for=\"ida\">Fecha de Ida</label>\n"; 
              echo "                        <input type=\"date\" value=\"2018-08-19\" class=\"form-control\" id=\"ida\" name=\"ida2\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que fecha es la ida?\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"regreso\">Fecha de Regreso</label>\n"; 
              echo "                        <input type=\"date\" value=\"2018-08-29\" class=\"form-control\" id=\"regreso\" name=\"regreso2\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que fecha es el regreso?\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"detalles\">Detalles</label>\n"; 
              echo "                        <textarea  class=\"form-control\" id=\"detalles\" rows=\"3\" value=\"\" name=\"detalles2\" required>¿Que incluye?</textarea>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          Indica que incluye este paquete.\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"precio\">Precio</label>\n"; 
              echo "                        <input type=\"text\" class=\"form-control\" id=\"precio\" placeholder=\"\" value=\"0\" name=\"precio2\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que precio tiene?\n"; 
              echo "                        </div>\n"; 
              echo "                        <br>\n"; 
              echo "                      </div>\n"; 
              echo "                      <div class=\"CommonAttribute DivElement1 col-md-6 mb-3 portfolio-item\"><br>\n"; 
              echo "                        <h4>Paquete 3</h4>\n"; 
              echo "                        <label for=\"ida\">Fecha de Ida</label>\n"; 
              echo "                        <input type=\"date\" value=\"2018-08-19\" class=\"form-control\" id=\"ida\" name=\"ida3\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que fecha es la ida?\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"regreso\">Fecha de Regreso</label>\n"; 
              echo "                        <input type=\"date\" value=\"2018-08-29\" class=\"form-control\" id=\"regreso\" name=\"regreso3\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que fecha es el regreso?\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"detalles\">Detalles</label>\n"; 
              echo "                        <textarea  class=\"form-control\" id=\"detalles\" rows=\"3\" value=\"\" name=\"detalles3\" required>¿Que incluye?</textarea>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          Indica que incluye este paquete.\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"precio\">Precio</label>\n"; 
              echo "                        <input type=\"text\" class=\"form-control\" id=\"precio\" placeholder=\"\" value=\"0\" name=\"precio3\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que precio tiene?\n"; 
              echo "                        </div>\n"; 
              echo "                        <br>\n"; 
              echo "                      </div>\n"; 
              echo "                      <div class=\"CommonAttribute DivElement1 col-md-6 mb-3 portfolio-item\"><br>\n"; 
              echo "                        <h4>Paquete 4</h4>\n"; 
              echo "                        <label for=\"ida\">Fecha de Ida</label>\n"; 
              echo "                        <input type=\"date\" value=\"2018-08-19\" class=\"form-control\" id=\"ida\" name=\"ida4\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que fecha es la ida?\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"regreso\">Fecha de Regreso</label>\n"; 
              echo "                        <input type=\"date\" value=\"2018-08-29\" class=\"form-control\" id=\"regreso\" name=\"regreso4\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que fecha es el regreso?\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"detalles\">Detalles</label>\n"; 
              echo "                        <textarea  class=\"form-control\" id=\"detalles\" rows=\"3\" value=\"\" name=\"detalles4\" required>¿Que incluye?</textarea>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          Indica que incluye este paquete.\n"; 
              echo "                        </div>\n"; 
              echo "                        <label for=\"precio\">Precio</label>\n"; 
              echo "                        <input type=\"text\" class=\"form-control\" id=\"precio\" placeholder=\"\" value=\"0\" name=\"precio4\" required>\n"; 
              echo "                        <div class=\"invalid-feedback\">\n"; 
              echo "                          ¿Que precio tiene?\n"; 
              echo "                        </div>\n"; 
              echo "                        <br>\n"; 
              echo "                      </div>\n"; 
              echo "                    </div>\n"; 
              echo "                   \n"; 
              echo "               \n"; 
              echo "                   \n"; 
              echo "                    \n"; 
              echo "                    <hr class=\"mb-4\">\n"; 
              echo "                    <button class=\"btn btn-success btn-lg btn-block\" type=\"submit\">Enviar registro</button>\n"; 
              echo "                  </form>\n"; 
              echo "                </div>\n"; 
              echo "              </div>\n"; 
              echo "<hr class=\"mb-4\"><hr class=\"mb-4\">\n"; 
              echo "              <footer class=\"my-5 pt-5 text-muted text-center text-small\">\n"; 
              echo "                <p class=\"mb-1\"></p>\n"; 
              echo "                <ul class=\"list-inline\">\n"; 
              echo "                  <li class=\"list-inline-item\"><a href=\"#\"></a></li>\n"; 
              echo "                  <li class=\"list-inline-item\"><a href=\"mailto:ayuda@agustirri.com\" class=\"btn btn-outline-info\">ayuda@agustirri.com</a></li>\n"; 
              echo "                  <li class=\"list-inline-item\"><a href=\"#\"></a></li>\n"; 
              echo "                </ul>\n"; 
              echo "              </footer>\n"; 
              echo "            </div>\n"; 
              echo "            <hr class=\"mb-4\"><hr class=\"mb-4\">\n"; 
              echo "        <!--Registroend-->\n";

          }
          $conn->close();
          ?>
        
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
       <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
    <script type="text/javascript">
      $(".DropdownClass").change(function () {
            if ($(this).attr('name') == 'Count') {
                var number = $(this).val();
                        
                $('.CommonAttribute').hide().slice( 0, number ).show();
            }
        });
    </script>

  </body>
</html>
