?>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $row["titulo"];?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Elige tu metodo de pago:</p>
                        <button type="button" class="btn btn-lg px-5 btn-light" data-toggle="modal" data-target="#Tarjetamodal">
                                <img src="img/tarjetas.png" height="60" alt="USA flag">
                            </button>&nbsp;
                            <button type="button" class="btn btn-lg px-5 btn-light" data-toggle="modal" data-target="#OxxoPayment">
                                <img src="img/oxxo.png" height="60" alt="USA flag">
                            </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="OxxoPayment" tabindex="-1" role="dialog" aria-labelledby="OxxoPayment" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $row["titulo"];?></h5>
                        
                      </div>
                      <form action="pay_oxxo.php" method="POST" >
                      <div class="modal-body">
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
                        </div>
                    </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Atras</button>
                        <input type="submit" value="Generar Ticket" class="btn btn-success">
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php

                echo "<div class=\"modal fade\" id=\"Tarjetamodal\">\n"; 
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
                    <p><span class="card-errors"></span></p>
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
                echo "<a href=\"#Tarjetamodal\" data-toggle=\"modal\" class=\"btn btn-info\" data-dismiss=\"modal\">< Atras</a>\n"; 
                
                echo "        <input type=\"submit\" value=\"Finalizar\" class=\"btn btn-success\">\n"; 
                echo "      </div>\n"; 
                echo "</form>";
                echo "    </div>\n"; 
                echo "  </div>\n"; 
                echo "</div>\n";
                