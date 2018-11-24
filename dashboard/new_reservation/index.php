<?php
// define variables and set to empty values
session_start();
require_once('../cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $viajesito = test_input($_POST["viajesito"]);
 echo "<!doctype html>\n"; 
echo "<html lang=\"en\">\n"; 
echo "  <head>\n"; 
echo "    <meta charset=\"utf-8\">\n"; 
echo "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\n"; 
echo "    <meta name=\"description\" content=\"\">\n"; 
echo "    <meta name=\"author\" content=\"\">\n"; 
echo "    <link rel=\"icon\" href=\"../../../../favicon.ico\">\n"; 
echo "     <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.0.13/css/all.css\" integrity=\"sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp\" crossorigin=\"anonymous\">\n"; 
echo "\n"; 
echo "    <title>Agustirri</title>\n"; 
echo "\n"; 
echo "    <!-- Bootstrap core CSS -->\n"; 
echo "    <link href=\"../../vendor/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">\n"; 
echo "    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>\n"; 
echo "    <!-- Custom styles for this template -->\n"; 
echo "    <link href=\"../dashboard.css\" rel=\"stylesheet\">\n"; 
echo "<link href=\"pricing.css\" rel=\"stylesheet\">\n";
echo "   \n"; 
echo "  </head>\n"; 
echo "\n"; 
echo "  <body>\n"; 
echo "    <nav class=\"navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow\">\n"; 
echo "      <a class=\"navbar-brand col-sm-3 col-md-2 mr-0\" href=\"../\"><img src=\"../../img/logo.png\" class=\"img-responsive\" style=\"width:18%\"></a>\n"; 
echo "      \n"; 
echo "      <ul class=\"navbar-nav px-3\">\n"; 
echo "        <li class=\"nav-item text-nowrap\">\n"; 
echo "          <a class=\"nav-link\" href=\"fin.php\">Cerrar sesion</a>\n"; 
echo "        </li>\n"; 
echo "      </ul>\n"; 
echo "    </nav>\n"; 
echo "\n"; 
echo "    <div class=\"container-fluid\">\n"; 
echo "      <div class=\"row\">\n"; 
echo "        <nav class=\"col-md-2 d-none d-md-block bg-light sidebar\">\n"; 
echo "          <div class=\"sidebar-sticky\">\n"; 
echo "            <ul class=\"nav flex-column\">\n"; 
echo "              &nbsp;\n"; 
echo "              <li class=\"nav-item\">\n"; 
echo "                <a class=\"nav-link\" href=\"../trips/\">\n"; 
echo "                  <span class=\"fas fa-suitcase\">&nbsp;</span>\n"; 
echo "                  Viajes <small>[beta]</small><span class=\"sr-only\"></span>\n"; 
echo "                </a>\n"; 
echo "              </li>\n"; 
echo "              \n"; 
echo "              <li class=\"nav-item\">\n"; 
echo "                <a class=\"nav-link active\" href=\"../\">\n"; 
echo "                  <span class=\"fas fa-bus\">&nbsp;</span>\n"; 
echo "                  Mis Reservas\n"; 
echo "                </a>\n"; 
echo "              </li>\n"; 
echo "             \n"; 
echo "            </ul>\n"; 
echo "\n"; 
echo "            <h6 class=\"sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted\">\n"; 
echo "             \n"; 
echo "              <a class=\"d-flex align-items-center text-muted\" href=\"#\">\n"; 
echo "              \n"; 
echo "              </a>\n"; 
echo "            </h6>\n"; 
echo "\n"; 
echo "            <ul class=\"nav flex-column mb-2\">\n"; 
echo "              <li class=\"nav-item \">\n"; 
echo "                <a class=\"nav-link \" href=\"../profile/\">\n"; 
echo "                  <span class=\"fas fa-user-cog\">&nbsp;</span>\n"; 
echo "                  Mi perfil\n"; 
echo "                </a>\n"; 
echo "              </li>\n"; 
echo "             \n"; 
echo "            </ul>\n"; 
echo "            <div class=\"fixed-bottom\"><p>&nbsp;<ul class=\"list-inline social-buttons\">\n"; 
echo "              <li class=\"list-inline-item\">\n"; 
echo "                <a href=\"#\">\n"; 
echo "                  <i class=\"fab fa-twitter\"></i>\n"; 
echo "                </a>\n"; 
echo "              </li>\n"; 
echo "              <li class=\"list-inline-item\">\n"; 
echo "                <a href=\"#\">\n"; 
echo "                  <i class=\"fab fa-facebook\"></i>\n"; 
echo "                </a>\n"; 
echo "              </li>\n"; 
echo "              <li class=\"list-inline-item\">\n"; 
echo "                <a href=\"#\">\n"; 
echo "                  <i class=\"fab fa-instagram\"></i>\n"; 
echo "                </a>\n"; 
echo "              </li>\n"; 
echo "            </ul></p><p>&nbsp;<span class=\"copyright small\">Copyright &copy; Agustirri 2018</span></p></div>\n"; 
echo "          </div>\n"; 
echo "        </nav>\n"; 
echo "\n"; 
echo "        <main role=\"main\" class=\"col-md-9 ml-sm-auto col-lg-10 px-4\">\n"; 
echo "\n"; 
//START
$sql = "SELECT titulo, origen, destino FROM viajes where id_viaje='".$viajesito."'";
$result = $conn->query($sql);
$num = 1;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "    <div class=\"pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center\">\n"; 
        echo "      <h1 class=\"display-4\">".$row["titulo"]."</h1>\n"; 

        echo "      <p class=\"lead\">Ultra Music Festival reúne a los mejores exponentes de la música electrónica durante 3 días y este año celebrara sus 21 años.";
        echo "<a href=\"https://ultramusicfestival.com/\" target=\"_blank\"> Ir al sitio.</a>\n";
        echo "</p>\n"; 
        echo "<p><b>Origen: </b>".$row["origen"]." <b></p>";
        echo "<p>Destino: </b>".$row["destino"]."</p>\n";
        echo "    </div>\n"; 
        echo "\n"; 
        echo "    <div class=\"container\">\n"; 
        echo "      <div class=\"card-deck mb-3 text-center\">\n"; 
        $sql2 = "SELECT id_paquete, fecha_ida, fecha_vuelta, incluido, precio FROM paquetes where id_viaje='".$viajesito."'";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            // output data of each row
            while($row2 = $result2->fetch_assoc()) {
                echo "        <div class=\"card mb-4 box-shadow\">\n"; 
                echo "          <div class=\"card-header\">\n"; 
                echo "            <h4 class=\"my-0 font-weight-normal\">Paquete ".$num."</h4>\n"; 
                echo "          </div>\n"; 
                echo "          <div class=\"card-body\">\n"; 
                echo "            <h1 class=\"card-title pricing-card-title\">$".number_format($row2["precio"])." <small class=\"text-muted\">mxn</small></h1>\n"; 
                echo "            <ul class=\"list-unstyled mt-3 mb-4\">\n"; 
                echo "<form action=\"../reserva.php\" method=\"post\">\n"; 
                          echo "  <input type=\"hidden\"  name=\"paquete\" value=\"".$row2["id_paquete"]."\">\n"; 
                echo "            <button type=\"submit\" class=\"btn btn-lg btn-block btn-outline-primary\">Quiero este</button><br>\n"; 
                echo "</form>\n";
                echo "              <li><b>Fecha: </b>".$row2["fecha_ida"]." <b>a</b> ".$row2["fecha_vuelta"].".</li>\n"; 
                echo "              <li>&nbsp;</li>\n"; 
                echo "              <li><b>¿Que contiene?</b></li>\n"; 
                echo "              <li>".$row2["incluido"]."</li>\n"; 
                echo "            </ul>\n"; 
                
                echo "          </div>\n"; 
                echo "        </div>\n"; 
                $num++;
            }
        } else {
            echo "0 results";
        }
        

        echo "        \n"; 
        echo "\n"; 
        echo "      </div>\n"; 
        echo "\n"; 
        echo "      \n"; 
        echo "    </div>\n";
        echo "\n"; 
    }
} else {
    echo "0 results";
}
$conn->close();
echo "&nbsp;<br>"; 
echo "&nbsp;<br>"; 
echo "&nbsp;"; 

//END
echo "        </main>\n"; 
echo "      </div>\n"; 
echo "    </div>\n"; 
echo "   \n"; 
echo "    <!-- Bootstrap core JavaScript\n"; 
echo "    ================================================== -->\n"; 
echo "    <!-- Placed at the end of the document so the pages load faster -->\n"; 
echo "    <script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>\n"; 
echo "    <script>window.jQuery || document.write('<script src=\"../../../../assets/js/vendor/jquery-slim.min.js\"><\/script>')</script>\n"; 
echo "    <script src=\"../../../../assets/js/vendor/popper.min.js\"></script>\n"; 
echo "    <script src=\"../../../../dist/js/bootstrap.min.js\"></script>\n"; 
echo "\n"; 
echo "    \n"; 
echo "   \n"; 
echo "  </body>\n"; 
echo "</html>\n";

 

    
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