<?php

require_once("../DB/UserDAO.php");
require_once("../Auth/sessao.php");

$obj = json_decode(file_get_contents('php://input'));

try {
    $user = UserDAO::getInstance();

    $userFromDB = $user->retrieveByUsername($obj->Username); // Recebe o usuário.

    if (!empty($userFromDB) && $userFromDB->getPassword() == $obj->Password) { // Verifica se a senha fornecida é a mesma da enviado pelo usuário.
        $chave = criarSessao($userFromDB->getUsername());
        if (!empty($chave)) {
            $dataAtual = round(microtime(true) * 1000);

            $expDateMs = $dataAtual + 20 * 60000; // Quando a sessao irá expirar para o usuário, ("Cookie será deletado");

            http_response_code(201);

            echo json_encode(array("message" => "Chave criada com sucesso.", "usuario"=> $userFromDB->getUsername(), "chave" => $chave, "expDateMs" => $expDateMs));
            
            //echo json_encode(array("message" => "Chave criada com sucesso.", "usuario"=> $userFromDB->getUsername(), "chave" => $chave));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Houve um erro ao gerar a chave."));
        }
    } else {
        http_response_code(401);
        echo json_encode(array("message" => "Senha ou Nome de Usuário Inválido"));
    }
} catch (Exception $e) {
    echo "Houve um erro durante a requisição de login: {$e->getMessage()}";
}    