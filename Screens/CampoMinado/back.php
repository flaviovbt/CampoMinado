<?php
    function pontuacao($dados){
            $tempo = ($dados->tempo < 0 ? ($dados->tempo * -1): $dados->tempo);
            if($dados->modo == "1")
                $tempo = (($dados->bombas*$dados->linhas*$dados->colunas)/3) - $tempo;

            $pontuacao = ($dados->bombas)/($dados->linhas * $dados->colunas) / $tempo;
            //echo "antes". round($pontuacao*100000);
        
            if($dados->modo == "1")
              $pontuacao *= 1.55;
            
            //echo "depois". round($pontuacao*100000);
          
            return round($pontuacao*100000);
    }

    if(isset($_POST['dados']))
    {
        $dados = json_decode($_POST['dados']);
        /*$array = ['colunas' => $dados->colunas, 'linhas' => $dados->linhas
        ,'bombas' => $dados->bombas, 'modo' => $dados->modo,
        'tempo' => ($dados->tempo < 0 ? ($dados->tempo * -1): $dados->tempo), 'resultado' => $dados->resultado,
        'pontos' => ($dados->resultado == 0 ? 0 : pontuacao($dados))];
        echo json_encode($array);*/

        require_once("../../php/DB/DAO.php");
        require_once("../../php/DB/PartidaDAO.php");
        require_once("../../php/DB/UserDAO.php");

        $user = UserDAO::getInstance()->retrieveByUsername($_COOKIE["usuario"]);

        $partida = PartidaDAO::getInstance()->insertNewPartida($user->getId(), $dados->colunas, $dados->linhas, $dados->bombas, date('d/m/y'), $dados->modo, ($dados->tempo < 0 ? ($dados->tempo * -1): $dados->tempo), ($dados->resultado == 0 ? 0 : pontuacao($dados)), $dados->resultado);
        if(!empty($partida)){
            
            http_response_code(200);
        }
        else {
            http_response_code(500);
            echo json_encode(array("message" => "Houve um erro a partida."));            
        }
    }

?>