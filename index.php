<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Agustirri</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom fonts for this template -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this  template -->
  <link href="css/agency.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="css/compact-gallery.css">

</head>

<body id="page-top">


  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="img/logo1.png" class="img-responsive" style="width:8%"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#portfolio">Viajes</a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" style="width:8%" href="tuviaje/">Publica un viaje</a>
          </li>

          <li class="nav-item">
            <?php
            session_start();
            if (isset($_SESSION['email'])){
              echo " <a class=\"nav-link js-scroll-trigger\" href=\"dashboard/\" alt=\"Iniciar sesion\">\n";
              echo "<span class=\"fas fa-user-astronaut fa-lg\" style=\"color:#f4d442\"></span>\n";
              echo "</a>\n";
            }else{
              echo " <a class=\"nav-link js-scroll-trigger\" href=\"sign-in/\" alt=\"Iniciar sesion\">\n";
              echo "<span class=\"fas fa-user-astronaut fa-lg\"></span>\n";
              echo "</a>\n";
            }

            ?>


          </li>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-lead-in"></div>
        <div class="intro-heading text-uppercase">Colecciona aventuras</div>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#portfolio">Viajar</a>
      </div>
    </div>
  </header>

  <!-- Services -->
  <section id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Asi de facil</h2>

        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-map fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Encuentra tu aventura</h4>
          <p class="text-muted">Salidas de diferentes partes del pais a eventos o lugares fabulosos.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Pagala como tu quieras</h4>
          <p class="text-muted">Oxxo, meses sin intereses, transferencia, etc.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-child fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">¡Viaja y vive!</h4>
          <p class="text-muted">Just enjoy :)</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio Grid -->
  <section class="bg-light" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Proximos viajes</h2>
          <h3 class="section-subheading text-muted">
           <!--<input class="form-control form-control-lg" type="text" placeholder="Buscar...">-->
         </h3>
       </div>
     </div>
     <div class="row">
      <style type="text/css">
      .whatever-your-class{
        width:50px;
        height:300px
      }
      .whatever-your-class2{
        width:100%;
        height:300px
        
      }
    </style>
    <?php
    require_once('dashboard/cn.php');
    $trips = array();
    $sql = "SELECT viajes.titulo, min(paquetes.precio) as 'precio', paquetes.incluido, paquetes.fecha_ida, paquetes.fecha_vuelta, viajes.activo, viajes.id_viaje FROM viajes inner JOIN paquetes ON paquetes.id_viaje = viajes.id_viaje where viajes.activo='1' GROUP by viajes.titulo";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
              // output data of each row
      while($row = $result->fetch_assoc()) {
        $trips[] = $row["id_viaje"];
        echo "<div class=\"col-md-4 col-sm-6 portfolio-item\">\n"; 
        echo "            <a class=\"portfolio-link\" data-toggle=\"modal\" href=\"#portfolioModal".$row["id_viaje"]."\">\n"; 
        echo "              <div class=\"portfolio-hover\">\n"; 
        echo "                <div class=\"portfolio-hover-content\">\n"; 
        echo "                  <i class=\"fa fa-plus fa-3x\"></i>\n"; 
        echo "                </div>\n"; 
        echo "              </div>\n"; 
        $thumbs = glob("trips/".$row["id_viaje"]."/principal/*.{jpg,png,gif,JPG,PNG}", GLOB_BRACE); 
        if(count($thumbs)) {
          natcasesort($thumbs);
          foreach($thumbs as $thumb) {
            echo "              <img class=\"img-fluid whatever-your-class\" src=\"".$thumb."\" style=\"width:100%\" >\n"; 

          }} else {
            echo "Sorry, no images to display!";
          }

          echo "            </a>\n"; 
          echo "            <div class=\"portfolio-caption\">\n"; 
          echo "              <h4>".$row["titulo"]."</h4>\n"; 
          echo "              <p class=\"text-muted\">Desde $".number_format($row["precio"])."</p>\n"; 
          echo "            </div>\n"; 
          echo "          </div>\n";
        }
      } else {
        echo "0 results";
      }

      ?>
    </div>
  </div>
</section>
          <!--<div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fa fa-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/02-thumbnail.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>Ultra Miami 2019</h4>
              <p class="text-muted">Desde $25,499</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal2">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fa fa-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/01-thumbnail.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>EDC Vegas 2019</h4>
              <p class="text-muted">Proximamente</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fa fa-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/06-thumbnail.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>Tomorrowland 2019</h4>
              <p class="text-muted">Proximamente</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fa fa-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/04-thumbnail.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>AMF 2019</h4>
              <p class="text-muted">Proximamente</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fa fa-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/05-thumbnail.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>Final Champions 2019</h4>
              <p class="text-muted">Proximamente</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" href="#">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fa fa-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/03-thumbnail.jpg" alt="">
            </a>
            <div class="portfolio-caption">
              <h4>Ultra Europe 2019</h4>
              <p class="text-muted">Proximamente</p>
            </div>
          </div>
        </div>
      </div>
    </section>-->

    <!-- About
    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">About</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <ul class="timeline">
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/about/1.jpg" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>2009-2011</h4>
                    <h4 class="subheading">Our Humble Beginnings</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/about/2.jpg" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>March 2011</h4>
                    <h4 class="subheading">An Agency is Born</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/about/3.jpg" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>December 2012</h4>
                    <h4 class="subheading">Transition to Full Service</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/about/4.jpg" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>July 2014</h4>
                    <h4 class="subheading">Phase Two Expansion</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <h4>Be Part
                    <br>Of Our
                    <br>Story!</h4>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Team
    <section class="bg-light" id="team">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Publica un viaje</h2>
            <h3 class="section-subheading text-muted">Diviertete ganando dinero.</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="team-member">
              <h4><span class="far fa-hand-point-right fa-5x"></span></h4>
              <h4>Completa el registro</h4>
              <p class="text-muted">Ingresa los detalles de tu viaje como imagenes, precio, itinerario, etc.</p>

            </div>
          </div>
          <div class="col-sm-4">
            <div class="team-member">
              <h4><span class="far fa-hand-point-right fa-5x"></span></h4>
              <h4>Invita a tu audiencia</h4>
              <p class="text-muted">Comparte el viaje por redes sociales.</p>

            </div>
          </div>
          <div class="col-sm-4">
            <div class="team-member">
              <h4><span class="far fa-hand-point-down fa-5x"></span></h4>

              <h4>Viaja</h4>
              <p class="text-muted">Una vez que cierres el viaje, disfruta la</p>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <p class="small text-muted">Letras chiquitas.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Clients
    <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="img/logos/envato.jpg" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="img/logos/designmodo.jpg" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="img/logos/themeforest.jpg" alt="">
            </a>
          </div>
          <div class="col-md-3 col-sm-6">
            <a href="#">
              <img class="img-fluid d-block mx-auto" src="img/logos/creative-market.jpg" alt="">
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Contact Us</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" name="sentMessage" novalidate="novalidate">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
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

    <!-- Portfolio Modals -->

    <!-- Modal 1 --><?php
    $sql = "SELECT * FROM viajes where activo=1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
              // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<div class=\"portfolio-modal modal fade\" id=\"portfolioModal".$row["id_viaje"]."\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n"; 
        echo "      <div class=\"modal-dialog\">\n"; 
        echo "        <div class=\"modal-content\">\n"; 
        echo "          <div class=\"close-modal\" data-dismiss=\"modal\">\n"; 
        echo "            <div class=\"lr\">\n"; 
        echo "              <div class=\"rl\"></div>\n"; 
        echo "            </div>\n"; 
        echo "          </div>\n"; 
        echo "          <div class=\"container\">\n"; 
        echo "            <div class=\"row\">\n"; 
        echo "              <div class=\" mx-auto\">\n"; 
        echo "                <div class=\"modal-body\">\n"; 
        echo "                  <!-- Project Details Go Here -->\n"; 
        echo "                  <h2 class=\"text-uppercase\">".$row["titulo"]."</h2>\n"; 
        echo "                  <p><b>Desde:</b> ".$row["origen"]."</p>\n"; 
        $thumbs = glob("trips/".$row["id_viaje"]."/principal/*.{jpg,png,gif,JPG,PNG}", GLOB_BRACE); 
        if(count($thumbs)) {
          natcasesort($thumbs);
          foreach($thumbs as $thumb) {
            echo "                  <img class=\"img-fluid d-block mx-auto\" src=\"".$thumb."\" alt=\"\">\n"; 

          }} else {
            echo "Sorry, no images to display!";
          }


          echo "                  <p>".$row["general_descripcion"]."</p>\n"; 
          echo "                  <div class=\"container\">\n"; 
          echo "                    <div class=\"card-deck mb-3 text-center\">\n";

          $sql2 = "SELECT id_paquete, fecha_ida, fecha_vuelta, incluido, precio FROM paquetes where id_viaje='".$row["id_viaje"]."'";
          $result2 = $conn->query($sql2);
          $num = 1;
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
              echo "              <li><b>Fecha: </b>".$row2["fecha_ida"]." <b>a</b> ".$row2["fecha_vuelta"].".</li>\n"; 
              echo "              <li>&nbsp;</li>\n"; 
              echo "              <li><b>¿Que contiene?</b></li>\n"; 
              echo "              <li>".$row2["incluido"]."</li>\n"; 
              echo "            </ul>\n"; 
              if (isset($_SESSION['email'])){
                echo " <a class=\"btn btn-lg btn-block btn-outline-primary\" href=\"dashboard/\" alt=\"Apartar Lugar\">\n";
                echo "Apartar Lugar";
                echo "</a>\n";
              }else{
                echo " <a class=\"btn btn-lg btn-block btn-outline-primary\" href=\"sign-in/\" alt=\"Apartar Lugar\">\n";
                echo "Apartar Lugar";
                echo "</a>\n";
              }
              echo "          </div>\n"; 
              echo "        </div>\n"; 
              $num++;
            }
          } else {
            echo "0 results";
          }


          echo "</div>\n"; 

          echo "<section class=\"gallery-block compact-gallery\">\n"; 
          echo "        <div class=\"container\">\n"; 
          echo "            <div class=\"heading\">\n"; 
          echo "                <h2>Galeria de imagenes:</h2>\n"; 
          echo "            </div>\n"; 
          echo "            <div class=\"row no-gutters\">\n"; 
          echo "               \n"; 
          $thumbs2 = glob("trips/".$row["id_viaje"]."/*.{jpg,png,gif,JPG,PNG}", GLOB_BRACE); 
        if(count($thumbs2)) {
          natcasesort($thumbs2);
          foreach($thumbs2 as $thumb2) {
            echo "                <div class=\"col-md-6 col-lg-4 item zoom-on-hover\">\n"; 
          echo "                    <a class=\"lightbox\" href=\"../img/image2.jpg\">\n"; 
          echo "                        <img class=\"img-fluid image whatever-your-class2\" src=\"".$thumb2."\">\n"; 

          echo "                    </a>\n"; 
          echo "                </div>\n"; 

          }} else {
            echo "Sorry, no images to display!";
          }
          echo "               \n"; 
          echo "            </div>\n"; 
          echo "        </div>\n"; 
          echo "    </section>\n";
          echo "                  </div>\n"; 
          echo "                  <!--<button class=\"btn btn-primary\" data-dismiss=\"modal\" type=\"button\">\n"; 
          echo "                    <i class=\"fa fa-times\"></i>\n"; 
          echo "                    </button>-->\n"; 
          echo "                </div>\n"; 
          echo "              </div>\n"; 
          echo "            </div>\n"; 
          echo "          </div>\n"; 
          echo "        </div>\n"; 
          echo "      </div>\n"; 
          echo "    </div>\n";
        }
      } else {
        echo "0 results";
      }
      ?>

      <!-- Modal 2 -->
      <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
              <div class="lr">
                <div class="rl"></div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-8 mx-auto">
                  <div class="modal-body">
                    <!-- Project Details Go Here -->
                    <h2 class="text-uppercase">Project Name</h2>
                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                    <img class="img-fluid d-block mx-auto" src="img/portfolio/02-thumbnail.jpg" alt="">
                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                    <ul class="list-inline">
                      <li>Date: January 2017</li>
                      <li>Client: Explore</li>
                      <li>Category: Graphic Design</li>
                    </ul>
                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                      <i class="fa fa-times"></i>
                    Close Project</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 3 -->
      <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
              <div class="lr">
                <div class="rl"></div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-8 mx-auto">
                  <div class="modal-body">
                    <!-- Project Details Go Here -->
                    <h2 class="text-uppercase">Project Name</h2>
                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                    <img class="img-fluid d-block mx-auto" src="img/portfolio/03-thumbnail.jpg" alt="">
                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                    <ul class="list-inline">
                      <li>Date: January 2017</li>
                      <li>Client: Finish</li>
                      <li>Category: Identity</li>
                    </ul>
                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                      <i class="fa fa-times"></i>
                    Close Project</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 4 -->
      <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
              <div class="lr">
                <div class="rl"></div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-8 mx-auto">
                  <div class="modal-body">
                    <!-- Project Details Go Here -->
                    <h2 class="text-uppercase">Project Name</h2>
                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                    <img class="img-fluid d-block mx-auto" src="img/portfolio/04-thumbnail.jpg" alt="">
                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                    <ul class="list-inline">
                      <li>Date: January 2017</li>
                      <li>Client: Lines</li>
                      <li>Category: Branding</li>
                    </ul>
                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                      <i class="fa fa-times"></i>
                    Close Project</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 5 -->
      <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
              <div class="lr">
                <div class="rl"></div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-8 mx-auto">
                  <div class="modal-body">
                    <!-- Project Details Go Here -->
                    <h2 class="text-uppercase">Project Name</h2>
                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                    <img class="img-fluid d-block mx-auto" src="img/portfolio/05-thumbnail.jpg" alt="">
                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                    <ul class="list-inline">
                      <li>Date: January 2017</li>
                      <li>Client: Southwest</li>
                      <li>Category: Website Design</li>
                    </ul>
                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                      <i class="fa fa-times"></i>
                    Close Project</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 6 -->
      <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
              <div class="lr">
                <div class="rl"></div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-8 mx-auto">
                  <div class="modal-body">
                    <!-- Project Details Go Here -->
                    <h2 class="text-uppercase">Project Name</h2>
                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                    <img class="img-fluid d-block mx-auto" src="img/portfolio/06-thumbnail.jpg" alt="">
                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                    <ul class="list-inline">
                      <li>Date: January 2017</li>
                      <li>Client: Window</li>
                      <li>Category: Photography</li>
                    </ul>
                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                      <i class="fa fa-times"></i>
                    Close Project</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Plugin JavaScript -->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

      <!-- Contact form JavaScript -->
      <script src="js/jqBootstrapValidation.js"></script>
      <script src="js/contact_me.js"></script>

      <!-- Custom scripts for this template -->
      <script src="js/agency.min.js"></script>

    </body>

    </html>
