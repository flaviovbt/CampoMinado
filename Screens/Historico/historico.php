<?php 
   include('../../php/Auth/sessao.php');
   sessaoValida();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Campo Minado - Histórico</title>
    <link rel="stylesheet" type="text/css" href="style.css" />

    <!--Favicon-->
    <link rel="shortcut icon" href="../../img/icon.ico" type="image/x-icon" />
    
    <!--Estilo NavBar-->
    <link rel="stylesheet" type="text/css" href="../../Components/Header/style.css"/>

    <!--Estilo Footer CSS-->
    <link rel="stylesheet" type="text/css" href="../../Components/Footer/style.css">

    <!--Fonte Londrina Solid-->
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300;400&display=swap" rel="stylesheet">

    <!--Fonte Neucha-->
    <link
      href="https://fonts.googleapis.com/css2?family=Neucha&display=swap"
      rel="stylesheet"
    />
    
    <!--Fonte Inter-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
  </head>

  <body>
    <?php
         include('../../Components/Header/nav.php');
    ?>
    <article class="container">
      <div class="nomeCentral">
        <h1>Histórico</h1>
      </div>

      <div class="info">
        <h2>Confira os resultados de suas partidas anteriores <span class="userInfo">Joselito25</span></h2>
      </div>

      <div class="content">
        <div class="botaoClassificacao">
            <div class="dropdown">
            <div class="dropbtn">Classificar por:</div>
              <div class="dropdown-content">
                <a href="#">Mais Recentes</a>
                <a href="#">Mais Antigos</a>
                <a href="#">Menor Tempo</a>
                <a href="#">Mais Bombas</a>
                <a href="#">Maior Pontuação</a>
              </div>
          </div>
        </div>

        <!-- HEADERS -->
        <table class="tabelaHistorico">
          <tr>
            <th style="width: 20%">Data</th>
            <th style="width: 10%">Bombas</th>
            <th style="width: 15%">Grid</th>
            <th style="width: 5%">Modalidade</th>
            <th style="width: 20%">Tempo</th>
            <th style="width: 20%">Pontuação</th>
            <th style="width: 10%">Resultado</th>
          </tr>

          <!-- PRIMEIRA LINHA -->

        </table>

      <div id="navHistorico">
        <div class="botaoVoltar">
          <a class="button">Voltar</a>
        </div>
        <div class="botaoAvancar">
          <a class="button">Avançar</a>
        </div>
      </div>

      </div>
    </article>
    <?php 
      include('../../Components/Footer/footer.php');
    ?>

    <script src="./script.js"></script>
  </body>
</html>
