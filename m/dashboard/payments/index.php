<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $reserva = $_POST["reserva"];

?>

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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Mis Pagos</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-toolbar mb-2 mb-md-0">

              <button class="btn btn-sm btn-outline-primary" id="btnClick"><i class="fas fa-question-circle"></i></button>
            </div>
          </div>
        </div>
          
            <?php
            require_once('../cn.php');
            $sql = "SELECT order_id, amount, card_info FROM payconek where id_reserva=".$reserva."";
            $result = $conn->query($sql);
            ?>
            <table class="table">
            <tr>
              <th>Referencia</th>
              <th>Monto</th>
              <th>Medio</th>
              <th>Solicitar Factura</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>\n"; 
                    echo "  <td>".$row["order_id"]."</td>\n"; 
                    echo "  <td>$ ".number_format(($row["amount"]/100),2)."</td>\n"; 
                    echo "  <td>".$row["card_info"]."</td>\n"; 
                    echo "  <td><button type=\"button\" class=\"btn btn-primary\"><i class=\"fas fa-receipt\"></i></button></td>\n"; 
                    echo "</tr>\n";
                }
            } else {
                echo "0 results";
            }
            ?>
            
          </table>

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
<?php  
}
else{
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../';
    </SCRIPT>");
}
?>