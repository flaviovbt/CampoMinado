<?php 
   include('../../php/Auth/sessao.php');
   sessaoValida();
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8" />
        <title>Campo Minado - Perfil</title>
        <link rel="stylesheet" type="text/css" href="style.css" />

        <!--Favicon-->
        <link rel="shortcut icon" href="../../img/icon.ico" type="image/x-icon" />

        <!--Fonte Londrina Solid-->
        <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300;400&display=swap"
            rel="stylesheet" />

        <!--Fonte Inter-->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet" />

        <!--Estilo Footer-->
        <link rel="stylesheet" type="text/css" href="../../Components/Footer/style.css" />

        <!--Estilo NavBar-->
        <link rel="stylesheet" type="text/css" href="../../Components/Header/style.css" />
    </head>

    <body>
        <?php
        include('../../Components/Header/nav.php');
    ?>
        <div class="tela">
            <div class="ladoEsquerdo">

                <div class="posicionamento ">
                    <img src="../../img/wallE.png" class="fotoPerfil" alt="Foto de Perfil" />
                    <label for="image"><img src="../../img/icon-camera.png" class="camerazinha" alt="Camera" />
                        <input type="file" accept="image/x-png,image/jpeg" id="image" name="image"
                            style="display:none;" />
                    </label>
                </div>

                <form>
                    <div class="fake-input">
                        <input type="text" placeholder="Nome" id="nome" name="Nome" disabled />
                        <label for="nome">
                            <img src="../../img/edit.png" alt="Editar" width=25 id="lapisNome" />
                        </label>

                    </div>

                    <div class="fake-input">
                        <input type="text" placeholder="Alterar data de nascimento (dd/mm/yyyy)" id="dtNas" name="dtNas"
                            disabled />
                        <label for="dtNas">
                            <img src="../../img/edit.png" alt="Editar" width=25 id="lapisDtNas" />
                        </label>
                    </div>

                    <div class="fake-input">
                        <input type="text" placeholder="Telefone" id="telefone" disabled name="telefone" />
                        <label for="telefone">
                            <img src="../../img/edit.png" alt="Editar" width=25 id="lapisTelefone" />
                        </label>
                    </div>

                    <div class="fake-input">
                        <input type="text" placeholder="Email" id="email" disabled name="email" />
                        <label for="email">
                            <img src="../../img/edit.png" alt="Editar" width=25 id="lapisEmail" />
                        </label>
                    </div>

                    <div class="fake-input">
                        <input type="password" placeholder="Senha" id="senha" name="senha" disabled />
                        <label for="senha">
                            <img src="../../img/edit.png" alt="Editar" width=25 id="lapisSenha" />
                        </label>
                    </div>

                    <div class="fake-input">
                        <input type="password" placeholder="Confirmar Senha" id="confirmarSenha" name="confirmarSenha"
                            disabled />
                        <label for="confirmarSenha">
                            <img src="../../img/edit.png" alt="Editar" width=25 id="lapisConfirmarSenha" />
                        </label>
                    </div>

                    <button id="enviar">Confirmar</button>
                </form>
            </div>

            <div class="verticalLine"></div>

            <?php
            require_once("../../php/DB/Partida.php");
            require_once("../../php/DB/PartidaDAO.php");
            require_once("../../php/DB/UserDAO.php");
            require_once("../../php/DB/User.php");
            $user = UserDAO::getInstance()->retrieveByUsername($_COOKIE['usuario']);
            $idUsuario = $user->getId();
            
            $arr = array();            
            $arr = PartidaDAO::getInstance()->retrieveByIdUser( $idUsuario);
            $maior = 0;
            if(!empty($arr)){
                $controle=0;
                foreach($arr as $row => $value){
                    if($value->getResultado() == 1){
                     $controle=1;
                    }
                }
            if($controle==1){
                    
            foreach($arr as $row => $value){
                if($value->getPontuacao()>$maior){
               $maior = $value->getPontuacao();
              $maiorRow = $row;
                }
            }
            $melhor = $arr[$maiorRow];
        
            $vetor = array();
            $vetor = PartidaDAO::getInstance()->retrieveByIdUser($idUsuario);
            $rapido = 9999;
           
            foreach($arr as $row => $value){
                if($value->getTempo()<$rapido){
               $rapido = $value->getTempo();
              $rapidoRow = $row;
                }
            }
            $speed = $vetor[$rapidoRow];
        
            $classificacaoSpeed = 1;
            $classificacaoMelhor = 1;
            $todos = array();
            $todos = PartidaDAO::getInstance()->retrieveAll();
         
            foreach($todos as $row => $value){
                if($value->getPontuacao()>$speed->getPontuacao()){
              $classificacaoSpeed ++;
                }
            }
            foreach($todos as $row => $value){
                if($value->getPontuacao()>$melhor->getPontuacao()){
              $classificacaoMelhor ++;
                }
            }
        
            $tempoVeloz = $speed->getTempo();
            $grid1Veloz = $speed->getGridCol();
            $grid2Veloz = $speed->getGridLin();
            //Colocao geral
            
            $tempoMelhorPartida = $melhor->getTempo();
            $grid1MelhorPartida = $melhor->getGridCol();
            $grid2MelhorPartida = $melhor->getGridLin();
            //Colocao geral



        }
    }


        if (empty($arr) or $controle == 0){
            $classificacaoMelhor = 0;
            $grid1MelhorPartida = 0;
            $grid2MelhorPartida = 0;
            $tempoMelhorPartida = 0;
            $classificacaoSpeed = 0;
            $grid1Veloz = 0;
            $grid2Veloz = 0;
            $tempoVeloz = 0;
            $vitorias = 0;
            $derrotas = 0;
            $total = 0;
        }
        $vitorias = 0;
        $derrotas = 0; 
        if (!empty($arr)){
        foreach($arr as $row => $value){
            if($value->getResultado() == 0)
            $derrotas++;
            elseif($value->getResultado() == 1)
            $vitorias++;
        }
        $total = $vitorias+$derrotas;
        }
    
            
           echo '<div class="ladoDireito">
                <div class="colocacaoGeral">
                    <div class="posicaoRelativa">
                        <p style="padding: 20px">Colocação Geral</p>
                    </div>

                    <div class="posicionamento2">
                        <div class="ranking">
                            <div class="insideRanking">
                                <p>#'.$classificacaoMelhor.'</p>
                            </div>
                        </div>

                       <div class="melhorPartida">
                            <div class="insideRetangulo">
                                <p>Melhor partida</p>
                            </div>
                        </div>

                        <div class="dimensoes">
                            <div class="insideDimensoes">
                                <p>'.$grid1MelhorPartida.'x'.$grid2MelhorPartida.'</p>
                            </div>
                        </div>
                        <div class="tempo">
                            <div class="insideTempo">
                                <p>'.$tempoMelhorPartida.'</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="colocacaoGeral">
                    <div class="posicaoRelativa">
                        <p style="padding-top: 90px;padding-bottom: 20px">Melhor tempo</p>
                    </div>
                    <div class="posicionamento2">
                    <div class="ranking">
                        <div class="insideRanking">
                            <p>#'.$classificacaoSpeed.'</p>
                        </div>
                    </div>

                    <div class="melhorPartida">
                        <div class="insideRetangulo">
                            <p>Melhor Tempo</p>
                        </div>
                    </div>

                    <div class="dimensoes">
                        <div class="insideDimensoes">
                            <p>'.$grid1Veloz.'x'.$grid2Veloz.'</p>
                        </div>
                    </div>
                    <div class="tempo">
                        <div class="insideTempo">
                            <p>'.$tempoVeloz.'</p>
                        </div>
                    </div>
                    </div>

                    <div class="posicaoRelativa2">
                      <div>
                        <p>Vitórias</p>
                        <div class="caixaDeBaixo">
                            <div class="insideBaixo">
                                <p>'.$vitorias.'</p>
                            </div>
                        </div>
                      </div>
                      <div>
                        <p>Derrrotas</p>
                        <div class="caixaDeBaixo">
                            <div class="insideBaixo">
                                <p>'.$derrotas.'</p>
                            </div>
                        </div>
                        </div>
                         <div>
                        <p>Total</p>
                        <div class="caixaDeBaixo">
                            <div class="insideBaixo">
                                <p>'.$total.'</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>'
            ?>
        </div>
        <?php 
            include('../../Components/Footer/footer.php');
        ?>

        <script type="module" src="script.js"></script>
    </body>

</html>