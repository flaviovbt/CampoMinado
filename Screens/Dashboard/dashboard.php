<?php 
   include('../../php/Auth/sessao.php');
   sessaoValida();
?>
<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <title>Campo Minado - Dashboard</title>
    <!--Favicon-->
    <link rel="shortcut icon" href="../../img/icon.ico" type="image/x-icon" />
    
    <!--Estilo Customizado CSS-->
    <link rel="stylesheet" type="text/css" href="style.css">

    <!--Estilo Footer CSS-->
    <link rel="stylesheet" type="text/css" href="../../Components/Footer/style.css">

    <!--Fonte Londrina Solid-->
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300;400&display=swap" rel="stylesheet">

    <!--Fonte Neucha-->
    <link href="https://fonts.googleapis.com/css2?family=Neucha&display=swap" rel="stylesheet">

    <!--Fonte Inter-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100&display=swap" rel="stylesheet">
  </head>

  <body>
    
    <header>
      <h1>A experiência definitiva de Campo Minado!</h1>
    </header>
    <div id="container">
      <article>
        <div id="info">
          <h2>Acesse os cards informativos para não pisar na bomba ou inicie a jogatina</h2>
        </div>
        <div id="card_area">
          <div class="group_cards">
            <a href="../CampoMinado/campoMinado.php">
              <div class="card">
                <h2>Jogar!</h2>
                <img src="../../img/bomb.png" alt="Bomba">
                <p>Jogue o melhor Campo Minado!</p>
              </div>
            </a>
            <a href="../Perfil/perfil.php">
              <div class="card">
                <h2>Perfil</h2>
                <img src="../../img/bomberman.png" alt="Bomberman">
                <p>Edite suas informações pessoais.</p>
              </div>
            </a>
        </div>
        <div class="group_cards">
          <a href="../Ranking/ranking.php">
            <div class="card">
              <h2>Ranking</h2>
              <img src="../../img/rank_img.png" alt="Ranking">
              <p>Visualize os melhores jogadores de Campo Minado.</p>
            </div>
          </a>
          <a href="../Historico/historico.php">
            <div class="card">
              <h2>Histórico</h2>
              <img src="../../img/clock_historic.png" alt="Relógio">
              <p>Verifique o histórico de suas partidas.</p>
            </div>
          </a>
        </div>
          
          <div id="exit">
            <a href="../../index.html">
              <div class="button" id="sair">
                <p>Sair</p>
              </div>
            </a>
          </div>
        </div>
      </article>
    </div>
    <?php 
      include('../../Components/Footer/footer.php');
    ?>
  </body>
  <script type="module" src="script.js"></script>
</html>