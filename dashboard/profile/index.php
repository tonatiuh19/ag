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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../"><img src="../../img/logo.png" class="img-responsive" style="width:18%"></a>
      
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
                <a class="nav-link" href="../trips/">
                  <span class="fas fa-suitcase">&nbsp;</span>
                  Viajes <small>[beta]</small><span class="sr-only"></span>
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
                <a class="nav-link active" href="#">
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
            <h1 class="h2">Mi perfil</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary" id="btnClick">Editar <span class="fas fa-pencil-alt"></span></button>
                <!--<button class="btn btn-sm btn-outline-secondary">Export</button>-->
              </div>
              <!--<button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>-->
            </div>
          </div>



          
          <?php
          require_once('../cn.php');

          $mail = $_SESSION['email'];
          $sql = "SELECT nombre, apellido, email, telefono FROM usuarios where email="."'".$mail."'"."";
          $result = $conn->query($sql);

          if ($result->num_rows >= 1) {
            
              while($row = $result->fetch_assoc()) {
                echo "<table class=\"table table-borderless\">\n"; 
                echo "            <tr>\n"; 
                echo "              <th>Nombre:</th>\n"; 
                echo "              <td>".$row["nombre"]."</td>\n"; 
                echo "            </tr>\n"; 
                echo "            <tr>\n"; 
                echo "              <th>Apellido:</th>\n"; 
                echo "              <td>".$row["apellido"]."</td>\n"; 
                echo "            </tr>\n"; 
                echo "            <tr>\n"; 
                echo "              <th>Email:</th>\n"; 
                echo "              <td>".$row["email"]."</td>\n"; 
                echo "            </tr>\n"; 
                echo "            <tr>\n"; 
                echo "              <th>Contraseña:</th>\n"; 
                echo "              <td>***********</td>\n"; 
                echo "            </tr>\n"; 
                echo "            <tr>\n"; 
                echo "              <th >Telefono:</th>\n"; 
                if ($row["telefono"] =! '') {
                    echo "              <td >".$row["telefono"]."</td>\n"; 
                }else{
                    echo "              <td >Aun no tienes telefono registrado</td>\n";
                }
               
                echo "            </tr>\n"; 
                echo "          </table>      \n";
                 
              }
          } else {
              echo "0 results";
          }
          
          ?>
        </div>

        <div id="2" style="display:none;">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Mi perfil</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
              <form class="form-signin" action="edit_profile.php" method="post">
                <button class="btn btn-sm btn-outline-success" type="submit">Listo <span class="fas fa-check"></span></button>
                <A class="btn btn-sm btn-outline-danger" HREF="javascript:history.go(0)">Cancelar <span class="fas fa-times"></span></A>
                
                <!--<button class="btn btn-sm btn-outline-secondary">Export</button>-->
              </div>
              <!--<button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>-->
            </div>
          </div>



          <form class="form-signin" action="" method="post">
          <?php
          require_once('../cn.php');

          $mail = $_SESSION['email'];
          $sql = "SELECT id_viaje FROM paquetes WHERE id_paquete IN (SELECT id_paquete FROM reservas WHERE email='".$mail."')";
          $result = $conn->query($sql);

          if ($result->num_rows >= 1) {
            
              while($row = $result->fetch_assoc()) {
               
               
              }
          } else {
              echo "0 results";
          }
        
          ?>
          
          </form>
          
        </div>

         
        

        </main>
      </div>
    </div>
  
    <script type="text/javascript">
     $('#btnClick').on('click',function(){
          if($('#1').css('display')!='none'){
          $('#2').show().siblings('div').hide();
          }else if($('#2').css('display')!='none'){
              $('#1').show().siblings('div').hide();
          }
      });
    </script>
      <script type="text/javascript">
      var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

      function validatePassword(){
        if(password.value != confirm_password.value) {
          confirm_password.setCustomValidity("Las contraseñas no coinciden");
        } else {
          confirm_password.setCustomValidity('');
        }
      }

      password.onchange = validatePassword;
      confirm_password.onkeyup = validatePassword;
          </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   

  </body>

</html>
