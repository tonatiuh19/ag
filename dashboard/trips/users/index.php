<?php
// define variables and set to empty values
session_start();
require_once('../../cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $viaje = test_input($_POST["viaje"]);

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
  <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
  <link href="form-validation.css" rel="stylesheet">
  <style type="text/css">
    .file-upload {
  background-color: #ffffff;
  width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: #17a2b8;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #15824B;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: #1bd6cc;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #17a2b8;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #17a2b8;
  border: 4px dashed #ffffff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  color: #15824B;
  padding: 60px 0;
}

.file-upload-image {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 200px;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}
.carousel-item img {
  width:100%
}
  </style>
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
              <a class="nav-link active" href="/dashboard/trips/">
                <span class="fas fa-suitcase">&nbsp;</span>
                Viajes <small class="text-muted">[beta]</small><span class="sr-only"></span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/dashboard/">
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
              <a class="nav-link" href="/dashboard/profile/">
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
          $sql = "SELECT activo, titulo, id_viaje FROM viajes where id_viaje='".$viaje."'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
            $dirname = "../../../trips/".$viaje."/principal/";
            $images = glob($dirname."*.{jpg,png,gif,PNG,JPG,GIF}", GLOB_BRACE);

            foreach($images as $image) {
                echo "<h1 class=\"h2\"><a href=\"#\" onclick=\"editphoto();\" data-toggle=\"tooltip\" title=\"Editar foto principal\"><img src=\"".$image."\" height=\"42\" width=\"42\"></a>\n";
                echo "\n";
                echo "<div class=\"modal fade\" id=\"editphoto\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n"; 
                echo "  <div class=\"modal-dialog\" role=\"document\">\n"; 
                echo "    <div class=\"modal-content\">\n"; 
                echo "      <div class=\"modal-header\">\n"; 
                echo "        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Cambiar foto principal</h5>\n"; 
                echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"; 
                echo "          <span aria-hidden=\"true\">&times;</span>\n"; 
                echo "        </button>\n"; 
                echo "      </div>\n"; 
                echo "      <div class=\"modal-body\">\n"; 
                echo "<form action=\"change_principalimage.php\" method=\"post\" enctype=\"multipart/form-data\">\n"; 
                echo "  <div class=\"form-group\">\n"; 
                echo "    <label for=\"exampleFormControlFile1\">Seleccionar imagen: </label>\n"; 
                echo "  <input type=\"hidden\"  name=\"viaje\" value=\"".$viaje."\">\n";
                echo "    <input type=\"file\" class=\"form-control-file\" accept=\"image/*\" name=\"fileToUpload\" id=\"fileToUpload\">\n"; 
                echo "  </div>\n"; 
                
                echo "      </div>\n"; 
                echo "      <div class=\"modal-footer\">\n"; 
                echo "        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancelar</button>\n"; 
                echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Guardar\" name=\"submit\">\n";
                echo "</form>\n"; 
                echo "      </div>\n"; 
                echo "    </div>\n"; 
                echo "  </div>\n"; 
                echo "</div>\n";
            }
            
            echo "".$row["titulo"]."</h1>\n";
            echo "            <div class=\"btn-toolbar mb-2 mb-md-0\">\n";
            echo "             \n";
            echo "\n";


            $sql2 = "SELECT f.nombre, f.apellido, f.email, f.telefono, f.activo, g.id_reserva, g.abonado, h.precio FROM usuarios as f
            left join reservas as g on f.email=g.email
            left join paquetes as h on g.id_paquete=h.id_paquete where h.id_viaje=".$viaje."";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows >= 1) {
              $sql4 = "SELECT f.email FROM usuarios as f
              left join reservas as g on f.email=g.email
              left join paquetes as h on g.id_paquete=h.id_paquete where h.id_viaje=".$viaje."";
              $result4 = $conn->query($sql4);

              if ($result4->num_rows > 0) {

                while($row4 = $result4->fetch_assoc()) {
                  $storeEmails[]=$row4["email"];
                }
              }
              //echo "              <button class=\"btn btn-sm btn-outline-info\" data-toggle=\"modal\" data-placement=\"bottom\" title=\"Envia correo general\" data-target=\"#mailtoAll\" type=\"button\">\n";
              //echo "                Correo a todos <span class=\"fas fa-envelope\"></span>\n";
              //echo "              </button>&nbsp;\n";
              echo "<button type=\"button\" class=\"btn btn-sm btn-outline-info\" data-toggle=\"modal\" data-target=\"#detailModal\">\n"; 
              echo "  Editar Detalles\n"; 
              echo "</button>&nbsp;\n"; 
              echo "<button type=\"button\" class=\"btn btn-sm btn-outline-info\" data-toggle=\"modal\" data-target=\"#paquetesModal\">\n"; 
              echo "  Editar Paquetes\n"; 
              echo "</button>&nbsp;\n"; 
              echo "<button type=\"button\" class=\"btn btn-sm btn-outline-info\" data-toggle=\"modal\" data-target=\"#fotosModal\">\n"; 
              echo "  <span class=\"far fa-plus-square\"></span> Fotos\n"; 
              echo "</button>&nbsp;\n"; 
              echo "              <button class=\"btn btn-sm btn-outline-info\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Ayuda\" type=\"button\">\n";
              echo "                <span class=\"fas fa-question-circle\"></span>\n";
              echo "              </button>\n";
              echo "\n";
              echo "            </div>\n";
              echo "          </div>\n";
              echo "      <table class=\"table table-hover\">\n";
              echo "        <thead class=\"table-borderless\">\n";
              echo "          <tr>\n";
              echo "            <th scope=\"col\">Reserva</th>\n";
              echo "            <th scope=\"col\">Paquete</th>\n";
              echo "            <th scope=\"col\">Nombre</th>\n";
              echo "            <th scope=\"col\">Apellido</th>\n";
              echo "            <th scope=\"col\">Email</th>\n";
              echo "            <th scope=\"col\">Telefono</th>\n";
              echo "            <th scope=\"col\">Abonado</th>\n";
              echo "            <th scope=\"col\">Restante</th>\n";
              echo "          </tr>\n";
              echo "        </thead>\n";
              echo "        <tbody>\n";

              echo "<div class=\"modal fade\" id=\"detailModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n"; 
              echo "  <div class=\"modal-dialog\" role=\"document\">\n"; 
              echo "    <div class=\"modal-content\">\n"; 
              echo "      <div class=\"modal-header\">\n"; 
              echo "        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Editar Detalles</h5>\n"; 
              echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"; 
              echo "          <span aria-hidden=\"true\">&times;</span>\n"; 
              echo "        </button>\n"; 
              echo "      </div>\n"; 
              echo "      <div class=\"modal-body\">\n"; 
              echo "<form action=\"update_detail.php\" method=\"post\">\n";
              $sql5 = "SELECT origen, destino, titulo FROM viajes where id_viaje=".$viaje."";
              $result5 = $conn->query($sql5);

              if ($result5->num_rows > 0) {
    // output data of each row
                while($row5 = $result5->fetch_assoc()) {

                  echo "  <div class=\"form-group\">\n"; 
                  echo "    <label for=\"formGroupExampleInput\">Titulo: </label>\n"; 
                  echo "    <input type=\"text\" class=\"form-control\" name=\"titulo\" placeholder=\"".$row5["titulo"]."\" value=\"".$row5["titulo"]."\" required>\n"; 
                  echo "  </div>\n"; 
                  echo "  <div class=\"form-group\">\n"; 
                  echo "    <label for=\"formGroupExampleInput2\">Origen: </label>\n"; 
                  echo "    <input type=\"text\" class=\"form-control\" name=\"origen\" placeholder=\"".$row5["origen"]."\" value=\"".$row5["origen"]."\" required>\n"; 
                  echo "  </div>\n"; 
                  echo "  <div class=\"form-group\">\n"; 
                  echo "    <label for=\"formGroupExampleInput2\">Destino: </label>\n"; 
                  echo "    <input type=\"text\" class=\"form-control\" name=\"destino\" placeholder=\"".$row5["destino"]."\" value=\"".$row5["destino"]."\" required>\n"; 
                  echo "  <input type=\"hidden\"  name=\"viaje\" value=\"".$viaje."\">\n";
                  echo "  </div>\n"; 
                  
                  
                }
              } 
              echo "      </div>\n"; 
              echo "      <div class=\"modal-footer\">\n"; 
              echo "        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancelar</button>\n"; 
              echo "        <button type=\"submit\" class=\"btn btn-primary\">Guardar</button>\n"; 

              echo "</form>\n";
              echo "      </div>\n"; 
              echo "    </div>\n"; 
              echo "  </div>\n"; 
              echo "</div>\n";

              echo "<div class=\"modal fade\" id=\"paquetesModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n"; 
              echo "  <div class=\"modal-dialog modal-lg\" role=\"document\">\n"; 
              echo "    <div class=\"modal-content\">\n"; 
              echo "      <div class=\"modal-header\">\n"; 
              echo "        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Editar Paquetes</h5>\n"; 

              echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n";
              //echo "          <span aria-hidden=\"true\">&times;</span>\n"; 
              echo "        </button>\n"; 
              echo "<a href=\"#newPackage\" class=\"float-right btn btn-sm btn-success-info\" data-toggle=\"modal\" data-dismiss=\"modal\"><span class=\"far fa-plus-square\"></span> Paquete</a>\n"; 

              echo "      </div>\n"; 
              echo "      <div class=\"modal-body\">\n"; 
              echo "<form action=\"update_package.php\" method=\"post\">\n";
              $num = 1;
              $sql6 = "SELECT precio, incluido, fecha_ida, fecha_vuelta, id_paquete FROM paquetes where id_viaje=".$viaje."";
              $result6 = $conn->query($sql6);

              if ($result6->num_rows > 0) {
                //echo "<div class=\"container\">\n"; 
                //echo "    <div class=\"row\">\n"; 
                while($row6 = $result6->fetch_assoc()) { 
                  echo "<p><div class=\"card\">\n"; 
                  echo "  <div class=\"card-header\">\n"; 
                  echo "    Paquete ".$num."\n"; 
                  echo "  </div>\n"; 
                  echo "  <div class=\"card-body\">\n"; 
                  echo "  <div class=\"form-group\">\n"; 
                  echo "    <label for=\"formGroupExampleInput\">Precio: </label>\n"; 
                  echo "    <input type=\"text\" class=\"form-control\" name=\"precio[]\" placeholder=\"".$row6["precio"]."\" value=\"".$row6["precio"]."\" required>\n"; 
                  echo "  </div>\n"; 
                  echo "  <div class=\"form-group\">\n"; 
                  echo "    <label for=\"formGroupExampleInput2\">¿Que incluye?: </label>\n"; 
                  echo "<textarea class=\"form-control\" rows=\"5\" name=\"incluido[]\" maxlength=\"300\" required>".$row6["incluido"]."</textarea>\n"; 
                  echo "  </div>\n"; 
                  echo "  <div class=\"form-group\">\n"; 
                  echo "    <label for=\"formGroupExampleInput2\">Fecha Ida: </label>\n"; 
                  echo "    <input type=\"date\" class=\"form-control\" name=\"fecha_ida[]\" placeholder=\"".$row6["fecha_ida"]."\" value=\"".$row6["fecha_ida"]."\" required>\n"; 
                  echo "  </div>\n";
                  echo "  <div class=\"form-group\">\n"; 
                  echo "    <label for=\"formGroupExampleInput2\">Fecha Regreso: </label>\n"; 
                  echo "    <input type=\"date\" class=\"form-control\" name=\"fecha_vuelta[]\" placeholder=\"".$row6["fecha_vuelta"]."\" value=\"".$row6["fecha_vuelta"]."\" required>\n"; 
                  echo "  <input type=\"hidden\"  name=\"id_paquete[]\" value=\"".$row6["id_paquete"]."\">\n";
                  echo "  <input type=\"hidden\"  name=\"viaje\" value=\"".$viaje."\">\n";
                  echo "  </div>\n";  
                  echo "  </div>\n"; 
                  echo "</div></p>\n";
                  $num++;
                  
                }
                //echo "    </div>\n"; 
                //echo "</div>\n"; 
              } 
              echo "      </div>\n"; 
              echo "      <div class=\"modal-footer\">\n"; 
              echo "        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancelar</button>\n"; 
              echo "        <button type=\"submit\" class=\"btn btn-primary\">Guardar</button>\n"; 
              echo "</form>\n";
              echo "      </div>\n"; 
              echo "    </div>\n"; 
              echo "  </div>\n"; 
              echo "</div>\n";

              echo "<div class=\"modal fade\" id=\"newPackage\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">\n"; 
              echo "  <div class=\"modal-dialog modal-lg\" role=\"document\">\n"; 
              echo "    <div class=\"modal-content\">\n"; 
              echo "      <div class=\"modal-header\">\n"; 
              echo "        <h5 class=\"modal-title\" id=\"exampleModalLongTitle\">Nuevo Paquete</h5>\n"; 
              echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"; 
              echo "          <span aria-hidden=\"true\">&times;</span>\n"; 
              echo "        </button>\n"; 
              echo "      </div>\n"; 
              echo "      <div class=\"modal-body\">\n"; 
              echo "<form action=\"new_package.php\" method=\"post\">\n";

              echo "  <div class=\"form-group\">\n"; 
              echo "    <label for=\"formGroupExampleInput\">Precio: </label>\n"; 
              echo "    <input type=\"text\" class=\"form-control\" name=\"precio\" placeholder=\"¿Cual es el precio?\" required>\n"; 
              echo "  </div>\n"; 
              echo "  <div class=\"form-group\">\n"; 
              echo "    <label for=\"formGroupExampleInput2\">¿Que incluye?: (max. 300 caracteres)</label>\n"; 
              echo "<textarea class=\"form-control\" rows=\"5\" name=\"incluido\" maxlength=\"300\" required>Hotel de lujo, una semana mas ...</textarea>\n";
              echo "  </div>\n"; 
              echo "  <div class=\"form-group\">\n"; 
              echo "    <label for=\"formGroupExampleInput2\">Fecha Ida: </label>\n"; 
              echo "    <input type=\"date\" class=\"form-control\" name=\"fecha_ida\" required>\n"; 

              echo "  </div>\n"; 
              echo "  <div class=\"form-group\">\n"; 
              echo "    <label for=\"formGroupExampleInput2\">Fecha Regreso: </label>\n"; 
              echo "    <input type=\"date\" class=\"form-control\" name=\"fecha_vuelta\" required>\n"; 

              echo "  </div>\n"; 
              echo "  <input type=\"hidden\"  name=\"viaje\" value=\"".$viaje."\">\n";
              echo "      </div>\n"; 
              echo "      <div class=\"modal-footer\">\n"; 
              echo "        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancelar</button>\n"; 
              echo "        <button type=\"submit\" class=\"btn btn-primary\">Guardar</button>\n"; 

              echo "</form>\n";
              echo "      </div>\n"; 
              echo "    </div>\n"; 
              echo "  </div>\n"; 
              echo "</div>\n";


              echo "<div class=\"modal fade\" id=\"fotosModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n"; 
              echo "  <div class=\"modal-dialog modal-lg\" role=\"document\">\n"; 
              echo "    <div class=\"modal-content\">\n"; 
              echo "      <div class=\"modal-header\">\n"; 
              echo "<form action=\"upload_image.php\" method=\"post\" enctype=\"multipart/form-data\">\n"; 
              echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n"; 
              echo "          <span aria-hidden=\"true\">&times;</span>\n"; 
              echo "        </button>\n"; 
              echo "      </div>\n"; 
              echo "      <div class=\"modal-body\">\n"; 
 
              $dir_path = "data/".$viaje."/";
              $extensions_array = array('jpg','png','jpeg');
              
              $open = $dir_path;

              if ($files = glob($open . "/*")) {
                  if(is_dir($dir_path))
                  {
                      $files = scandir($dir_path);
                      echo "<div id=\"demo\" class=\"carousel slide\" data-ride=\"carousel\">\n"; 
                      echo "  <div class=\"carousel-inner\">\n";
                      for($i = 0; $i < count($files); $i++)
                      {
                          if (preg_match("/^[^\.].*$/", $files[$i])) {

                            if($files[$i] !='.' && $files[$i] !='..')
                            {
                                // get file name
                                //echo "File Name -> $files[$i]<br>" ;
                                echo "<div class=\"carousel-item\">\n"; 
                               echo "<img src='data/".$viaje."/".$files[$i]."'>"; 
                                echo "</div>\n";
                                
                                // get file extension
                                $file = pathinfo($files[$i]);
                               // $extension = $file['extension'];
                                //echo "File Extension-> $extension<br>";
                                
                               
                            }

                           } 

                      }
                      echo "  </div>\n"; 
                      echo "  <a class=\"carousel-control-prev\" href=\"#demo\" data-slide=\"prev\">\n"; 
                      echo "    <span class=\"carousel-control-prev-icon\"></span>\n"; 
                      echo "  </a>\n"; 
                      echo "  <a class=\"carousel-control-next\" href=\"#demo\" data-slide=\"next\">\n"; 
                      echo "    <span class=\"carousel-control-next-icon\"></span>\n"; 
                      echo "  </a>\n"; 
                      echo "</div>\n"; 
                      echo "\n";
                  }
                echo "<div class=\"file-upload\">\n"; 
                echo "  <button class=\"file-upload-btn\" type=\"button\" onclick=\"$('.file-upload-input').trigger( 'click' )\">Añadir Imagen</button>\n"; 

                echo "\n"; 
                echo "  <div class=\"image-upload-wrap\">\n"; 
                echo "  <input type=\"hidden\"  name=\"viaje\" value=\"".$viaje."\">\n";
                echo "    <input class=\"file-upload-input\" type='file' onchange=\"readURL(this);\" accept=\"image/*\" name=\"fileToUpload\" id=\"fileToUpload\" />\n"; 
                echo "  </div>\n"; 
                echo "  <div class=\"file-upload-content\">\n"; 
                echo "    <img class=\"file-upload-image\" src=\"#\" alt=\"your image\" />\n"; 
                echo "    <div class=\"image-title-wrap\">\n"; 
                echo "      <button type=\"button\" onclick=\"removeUpload()\" class=\"remove-image\">Remover <span class=\"image-title\">Uploaded Image</span></button>\n"; 
                echo "    </div>\n"; 
                echo "  </div>\n"; 
                echo "</div>\n";
              } else {
                echo "<div class=\"file-upload\">\n"; 
                echo "  <button class=\"file-upload-btn\" type=\"button\" onclick=\"$('.file-upload-input').trigger( 'click' )\">Añadir Imagen</button>\n"; 

                echo "\n"; 
                echo "  <div class=\"image-upload-wrap\">\n"; 
                echo "  <input type=\"hidden\"  name=\"viaje\" value=\"".$viaje."\">\n";
                echo "    <input class=\"file-upload-input\" type='file' onchange=\"readURL(this);\" accept=\"image/*\" name=\"fileToUpload\" id=\"fileToUpload\" />\n"; 
                echo "  </div>\n"; 
                echo "  <div class=\"file-upload-content\">\n"; 
                echo "    <img class=\"file-upload-image\" src=\"#\" alt=\"your image\" />\n"; 
                echo "    <div class=\"image-title-wrap\">\n"; 
                echo "      <button type=\"button\" onclick=\"removeUpload()\" class=\"remove-image\">Remover <span class=\"image-title\">Uploaded Image</span></button>\n"; 
                echo "    </div>\n"; 
                echo "  </div>\n"; 
                echo "</div>\n";
              }
              


              echo "      </div>\n"; 
              echo "      <div class=\"modal-footer\">\n"; 
              echo "        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancelar</button>\n"; 
              echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Guardar\" name=\"submit\">\n";
              echo "</form>\n";
              echo "      </div>\n"; 
              echo "    </div>\n"; 
              echo "  </div>\n"; 
              echo "</div>\n";

              while($row2 = $result2->fetch_assoc()) {
                echo "          <tr>\n";
                echo "            <th scope=\"row\">".$row2["id_reserva"]."</th>\n";
                echo "            <td>$ ".number_format($row2["precio"])."</td>\n";
                echo "            <td>".$row2["nombre"]."</td>\n";
                echo "            <td>".$row2["apellido"]."</td>\n";
                echo "            <td>".$row2["email"]." <button type=\"button\" class=\"btn btn-warning btn-sm\" data-toggle=\"modal\" data-target=\"#mailModal".$row2["id_reserva"]."\"><span class=\"fas fa-envelope\"></span></button></td>\n";
                echo "            <td>".$row2["telefono"]."</td>\n";
                $falta = floatval($row2["precio"]) - floatval($row2["abonado"]);
                $validationinputmax = floatval($row2["precio"])+1;
                if ($falta == 0) {
                  echo "            <td class=\"table-success\" colspan=\"2\" align=\"center\"><b>Pagado</b> <button type=\"button\" class=\"btn btn-info btn-sm\" data-toggle=\"modal\" data-target=\"#exampleModal".$row2["id_reserva"]."\"><span class=\"fas fa-ticket-alt\"></span></button></td>\n";
                }else{
                  echo "            <td class=\"table-success\">$ ".number_format($row2["abonado"])." <button type=\"button\" class=\"btn btn-warning btn-sm\" data-toggle=\"modal\" data-target=\"#exampleModal".$row2["id_reserva"]."\"><span class=\"far fa-edit\"></span></button></td>\n";
                  echo "            <td class=\"table-danger\">$ ".number_format($falta)."</td>\n";
                }
                echo "<div class=\"modal fade\" id=\"exampleModal".$row2["id_reserva"]."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n";
                echo "  <div class=\"modal-dialog\" role=\"document\">\n";
                echo "    <div class=\"modal-content\">\n";
                echo "      <div class=\"modal-header\">\n";
                echo "        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Editar abonado: <b class=\"font-italic\">".$row2["nombre"]." ".$row2["apellido"]."</b></h5>\n";
                echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n";
                echo "          <span aria-hidden=\"true\">&times;</span>\n";
                echo "        </button>\n";
                echo "      </div>\n";
                echo "      <div class=\"modal-body\">\n";
                echo "  <div class=\"form-group\">\n";
                echo "<form action=\"update_abono.php\" method=\"post\">\n";
                echo "    <label for=\"exampleInputEmail1\">Abonado: </label>\n";
                echo "    <input type=\"number\" class=\"form-control\" name=\"nvalue\" aria-describedby=\"emailHelp\" placeholder=\"$ ".$row2["abonado"]."\" min=\"".$row2["abonado"]."\" max=\"".$validationinputmax."\">\n";
                echo "  <input type=\"hidden\"  name=\"reserva\" value=\"".$row2["id_reserva"]."\">\n";
                echo "  <input type=\"hidden\"  name=\"viaje\" value=\"".$viaje."\">\n";
                echo "<small>No se puede disminuir el valor actual del usuario. Si se necesita modificar este valor, mandar correo a <i>cambio.usuario@agustirri.com</i> con justificacion</small>\n";
                echo "  </div>\n";
                echo "      </div>\n";
                echo "      <div class=\"modal-footer\">\n";
                echo "        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancelar</button>\n";
                echo "        <button type=\"submit\" class=\"btn btn-primary\">Actualizar</button>\n";
                echo "</form>\n";
                echo "      </div>\n";
                echo "    </div>\n";
                echo "  </div>\n";
                echo "</div>\n";

                echo "<div class=\"modal fade\" id=\"mailModal".$row2["id_reserva"]."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n";
                echo "  <div class=\"modal-dialog modal-lg\" role=\"document\">\n";
                echo "    <div class=\"modal-content\">\n";
                echo "      <div class=\"modal-header\">\n";
                echo "        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Correo a: <b class=\"font-italic\">".$row2["nombre"]." ".$row2["apellido"]."</b></h5>\n";
                echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n";
                echo "          <span aria-hidden=\"true\">&times;</span>\n";
                echo "        </button>\n";
                echo "      </div>\n";
                echo "      <div class=\"modal-body\">\n";
                echo "<form action=\"mailto.php\" method=\"post\" enctype=\"multipart/form-data\" >";
                echo "<div class=\"form-group\">\n";
                echo "    <label for=\"exampleFormControlTextarea1\">Hola,  </label>\n";
                echo "    <textarea class=\"form-control\" name=\"message\" rows=\"5\" required></textarea>\n";
                echo "    <label for=\"exampleFormControlTextarea1\">Saludos cordiales.<br>Creador de tu aventura.</label>\n";
                echo "  </div>\n";
                echo "        <div class=\"input-group mb-3\">\n";

                echo "  <div class=\"form-group\">\n";
                echo "    <label for=\"exampleFormControlFile1\"><b>Algun archivo adjunto (opcional):</b></label>\n";
                echo "    <input type=\"file\" class=\"form-control-file\" name=\"uploaded_file\" id=\"exampleFormControlFile1\">\n";
                echo "  </div>\n";
                echo "Extensiones permitidas: .gif, .png, .jpg, .jpeg, .pdf, .doc, .ppt";
                echo "        </div>\n";
                echo "      </div>\n";
                echo "      <div class=\"modal-footer\">\n";
                echo "  <input type=\"hidden\"  name=\"titulo\" value=\"".$row["titulo"]."\">\n";
                echo "  <input type=\"hidden\"  name=\"email_u\" value=\"".$_SESSION['email']."\">\n";
                echo "  <input type=\"hidden\"  name=\"name_c\" value=\"".$row2["nombre"]." ".$row2["apellido"]."\">\n";
                echo "  <input type=\"hidden\"  name=\"email_c\" value=\"".$row2["email"]."\">\n";
                echo "  <input type=\"hidden\"  name=\"viaje\" value=\"".$viaje."\">\n";
                echo "        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancelar</button>\n";
                echo "        <button type=\"submit\" class=\"btn btn-primary\" name=\"setAlg\">Enviar</button>\n";
                echo "</form>";
                echo "      </div>\n";
                echo "    </div>\n";
                echo "  </div>\n";
                echo "</div>\n";


                echo "<div class=\"modal fade\" id=\"mailtoAll\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">\n";
                echo "  <div class=\"modal-dialog modal-lg\" role=\"document\">\n";
                echo "    <div class=\"modal-content\">\n";
                echo "      <div class=\"modal-header\">\n";
                echo "        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Correo general</h5>\n";
                echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n";
                echo "          <span aria-hidden=\"true\">&times;</span>\n";
                echo "        </button>\n";
                echo "      </div>\n";
                echo "      <div class=\"modal-body\">\n";
                echo "<form action=\"mailtoall.php\" method=\"post\" enctype=\"multipart/form-data\" >";
                echo "<div class=\"form-group\">\n";
                echo "    <label for=\"exampleFormControlTextarea1\">Hola,  </label>\n";
                echo "    <textarea class=\"form-control\" name=\"message\" rows=\"5\" required></textarea>\n";
                echo "    <label for=\"exampleFormControlTextarea1\">Saludos cordiales.<br>Creador de tu aventura.</label>\n";
                echo "  </div>\n";
                echo "        <div class=\"input-group mb-3\">\n";

                echo "  <div class=\"form-group\">\n";
                echo "    <label for=\"exampleFormControlFile1\"><b>Algun archivo adjunto (opcional):</b></label>\n";
                echo "    <input type=\"file\" class=\"form-control-file\" name=\"uploaded_file\" id=\"exampleFormControlFile1\">\n";
                echo "  </div>\n";
                echo "Extensiones permitidas: .gif, .png, .jpg, .jpeg, .pdf, .doc, .ppt";
                echo "        </div>\n";
                echo "      </div>\n";
                echo "      <div class=\"modal-footer\">\n";
                echo "  <input type=\"hidden\"  name=\"titulo\" value=\"".$row["titulo"]."\">\n";
                echo "  <input type=\"hidden\"  name=\"email_u\" value=\"".$_SESSION['email']."\">\n";
                echo "  <input type=\"hidden\"  name=\"name_c\" value=\"".$row2["nombre"]." ".$row2["apellido"]."\">\n";
                foreach($storeEmails as $value)
                {
                  echo '<input type="hidden" name="result[]" value="'. $value. '">';
                }
                echo "  <input type=\"hidden\"  name=\"email_c\" value=\"".$row2["email"]."\">\n";
                echo "  <input type=\"hidden\"  name=\"viaje\" value=\"".$viaje."\">\n";
                echo "        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancelar</button>\n";
                echo "        <button type=\"submit\" class=\"btn btn-primary\" name=\"setAlg\">Enviar</button>\n";
                echo "</form>";
                echo "      </div>\n";
                echo "    </div>\n";
                echo "  </div>\n";
                echo "</div>\n";

                echo "          </tr>\n";
              }
              echo "        </tbody>\n";
              echo "      </table>\n";
            } else {

              echo "              <button class=\"btn btn-sm btn-outline-info\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Ayuda\" type=\"button\">\n";
              echo "                <span class=\"fas fa-question-circle\"></span>\n";
              echo "              </button>\n";
              echo "\n";
              echo "            </div>\n";
              echo "          </div>\n";
              echo "<div class=\"jumbotron\">\n";
              echo "  <h1 class=\"display-4\">Aun no tienes tripulantes</h1>\n";
              echo "  <p class=\"lead\">Es momento de invitar a tus amigos.</p>\n";
              echo "  <hr class=\"my-4\">\n";

              echo "  <p class=\"lead\">\n";
              echo "    <a class=\"btn btn-primary btn-lg\" href=\"#\" role=\"button\">Compartir</a>\n";
              echo "  </p>\n";
              echo "</div>\n";
            }



          }
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
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
      </script>
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
    <script>
    //$('input[type=file]').change(function () {
      $("input[name='uploaded_file']").change(function() {
        var fileName = $(this).val().split('/').pop().split('\\').pop();
        var ext = $(this).val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg','pdf','doc','ppt']) == -1) {
          alert('Extension invalida');
          $(function(){
            $("button[name='setAlg']").attr("disabled", true);
          });
        }else{
          $(function(){
            $("button[name='setAlg']").attr("disabled", false);
          });
        }
        console.log(fileName);
      });


    //});

  </script>
  <script type="text/javascript">
    $(".DropdownClass").change(function () {
      if ($(this).attr('name') == 'Count') {
        var number = $(this).val();

        $('.CommonAttribute').hide().slice( 0, number ).show();
      }
    });
  </script>
  <script type="text/javascript">
    function editphoto(){
      $('#editphoto').modal('show')
    }
  </script>
  <script>
$(document).on('ready', function() {
    $("#input-b9").fileinput({
        showPreview: false,
        showUpload: false,
        elErrorContainer: '#kartik-file-errors',
        allowedFileExtensions: ["jpg", "png", "gif"]
        //uploadUrl: '/site/file-upload-single'
    });
});
</script>
<script type="text/javascript">
  function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});

</script>

</body>
</html>

<?php

}else{
  echo ("<SCRIPT LANGUAGE='JavaScript'>

    window.location.href='/dashboard/trips';
    </SCRIPT>");
}



function get_random_string($length = 11){
  $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

  return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
}



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>
