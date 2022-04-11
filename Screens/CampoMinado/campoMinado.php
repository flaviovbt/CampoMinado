<?php 
   include('../../php/Auth/sessao.php');
   sessaoValida();
?>

<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="UTF-8" />
      <title>Campo Minado - Jogar</title>
      <link rel="stylesheet" type="text/css" href="style.css"/>

      <!--Favicon-->
      <link rel="shortcut icon" href="../../img/icon.ico" type="image/x-icon" />
    
      <!--Estilo Footer-->
      <link rel="stylesheet" type="text/css" href="../../Components/Footer/style.css" />

      <!--Fonte Londrina Solid-->
      <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300;400&display=swap" rel="stylesheet">

      <!--Fonte Inter-->
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
  
      <!--Estilo NavBar-->
      <link rel="stylesheet" type="text/css" href="../../Components/Header/style.css" />

      
   </head>
   <body>
      <?php
         include('../../Components/Header/nav.php');
      ?>
      <article class="container">
         <div class="jogoContainer">
            <div class="headerJogoContainer">
               <div class="headerJogoContent">
                  <div class="itemHeaderJogo">
                     <h2>Ajustes:</h2>
                  </div>
                  <div class="itemHeaderJogo">
                     <h4>Tempo(s):</h4>
                     <div class="textBoxOrange">
                        <p id="timer">0</p>
                     </div>
                  </div>
                  <div class="itemHeaderJogo">
                     <h4>Número de bombas:</h4>
                     <div class="textBoxOrange">
                         <input class="hudInput2" type="number" id="nbombas" name="nbombas">
                     </div>
                  </div>
                  <div class="itemHeaderJogo">
                     <h4>Dimensões:</h4>
                     <div class="textBoxOrange">
                        <input class="hudInput" type="number" id="dimensao1" name="dimensao1" onkeydown="return false">
                        <p id="x" > X </p>
                        <input class="hudInput" type="number" id="dimensao2" name="dimensao2" onkeydown="return false">
                     </div>
                  </div>
                  <div class="itemHeaderJogo">
                     <h4>Modo:</h4>
                     <div class="switchBox" onclick="alteraModo()">
                        <div id="modoClassico" class="switchOn">
                           <p>Clássico</p>
                        </div>
                        <div id="modoRivotril" class="switchOff">
                           <p>Rivotril</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="jogoContent">
                <div class="headerGameArea">
                  <h1><span style="color:#ffff;">Campo</span> Minado</h1>
                </div>
                <div id="borda">
                  <table id="tabela"></table>
                
                  <table id="trapaca"></table>
                </div>
                  <button class="startButton" id="sbt" onclick="startGame()">Iniciar Jogo
                  </button>
                  <button class="restartButton"  id= "rst" onclick="restartGame()">
                  Reiniciar
                  </button>
            </div>
         </div>
         <div class="hackerArea" onmouseover="trapaca()" onmouseout="normal()">
                <img src="../../img/hacker_icon.png" alt="Hacker Icon" />
                <div class="trapacaButton" > 
                 <p> TRAPAÇA </p>
              </div>
             </div>
      </article>

      <?php 
         include('../../Components/Footer/footer.php');
      ?>
       <script src="scripts.js"></script>
   </body>
</html>