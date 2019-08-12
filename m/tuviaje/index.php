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
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
     <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
     <style type="text/css">
       #inner {
        display: table;
        margin: 0 auto;
      }

     </style>


  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="../"><img src="../img/logo.png" class="img-responsive" style="width:8%"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

            <li class="nav-item">
              <?php
                session_start();
                if (isset($_SESSION['email'])){
                  echo " <a class=\"nav-link js-scroll-trigger\" href=\"../dashboard/\" alt=\"Iniciar sesion\">\n";
                  echo "<span class=\"fas fa-user-astronaut fa-lg\" style=\"color:#f4d442\"></span>\n";
                  echo "</a>\n";
                }else{
                  echo " <a class=\"nav-link js-scroll-trigger\" href=\"../sign-in/\" alt=\"Iniciar sesion\">\n";
                  echo "<span class=\"fas fa-user-astronaut fa-lg\"></span>\n";
                  echo "</a>\n";
                }

              ?>


            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Publica tu viaje</h1>
              <span class="subheading">¿Tienes una agencia de viajes o eres un experto en organizar viajes?</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
           <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase"></h2>
            <h3 class="section-subheading text-muted">Diviertete ganando dinero.</h3><p></p><p></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="team-member">
              <h4 id="inner"><span class="far fa-hand-point-right fa-5x"></span></h4>
              <p><h4>Completa el registro</h4>
              <span class="text-muted">Ingresa los detalles de tu viaje como imagenes, precio, itinerario, etc.</span></p>

            </div>
          </div>
          <div class="col-sm-4">
            <div class="team-member">
              <h4 id="inner"><span class="far fa-hand-point-right fa-5x"></span></h4>
              <p><h4>Invita a tu audiencia</h4>
              <span class="text-muted">Comparte el viaje por redes sociales y recibe pagos por los mejores medios (Oxxo, meses sin intereses, etc).</span></p>

            </div>
          </div>
          <div class="col-sm-4">
            <div class="team-member">
              <h4 id="inner"><span class="far fa-hand-point-down fa-5x"></span></h4>

              <p><h4>Viaja</h4>
              <span class="text-muted">Una vez que cierres el viaje, disfruta la aventura.</span></p>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <a href="../dashboard/" class="btn btn-success">Empezar</a>
          </div>
      </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">

              <li class="list-inline-item">
                <a href="https://www.facebook.com/Agustirri-448992722238113">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            </ul>
            <p class="copyright text-muted">Copyright &copy; Agustirri 2018</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

  </body>

</html>
