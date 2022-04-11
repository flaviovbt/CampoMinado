<?php 
   include('../../php/Auth/sessao.php');
   sessaoValida();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Campo Minado - Ranking Global</title>
    <link rel="stylesheet" type="text/css" href="style.css" />

    <!--Favicon-->
    <link rel="shortcut icon" href="../../img/icon.ico" type="image/x-icon" />
  
    <!--Estilo NavBar-->
    <link
      rel="stylesheet"
      type="text/css"
      href="../../Components/Header/style.css"
    />

    <!--Estilo Footer CSS-->
    <link rel="stylesheet" type="text/css" href="../../Components/Footer/style.css">

    <!--Fonte Londrina Solid-->
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300;400&display=swap" rel="stylesheet">

    <!--Fonte Inter-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">

    <!--Fonte Neucha-->
    <link
      href="https://fonts.googleapis.com/css2?family=Neucha&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>
      <?php
         include('../../Components/Header/nav.php');
      ?>
    <article class="container">
      <div class="nomeCentral">
        <h1>Ranking Global</h1>
      </div>

      <div class="info">
        <h2>
          Os melhores e maiores jogadores de Campo Minado da Unicamp estão aqui
        </h2>
      </div>

      <div class="content">
        <!-- HEADERS -->
        <table class="tabelaRankingGlobal">
          <tr>
            <th style="width: 5%">Posição</th>
            <th style="width: 40%">Usuário</th>
            <th style="width: 20%">Grid</th>
            <th style="width: 20%">Tempo</th>
            <th style="width: 15%;">Pontuação</th>
          </tr>

        </table>
        
      </div>
    </article>
    <?php 
      include('../../Components/Footer/footer.php');
    ?>
    <script src="./script.js"></script>
  </body> 
</html>
