<?php
require_once("sessao.php");

$obj = json_decode(file_get_contents('php://input'));

$username = $obj->Username;
$chave = $obj->Chave;

$return = verificaSessao($username, $chave);

if ($return === True){
    destruirSessao();
    http_response_code(200);
    echo json_encode(array("message"=> "Usuário destruido com sucesso!", "usuario" => $username, "chave" => $chave));
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "Ocorreu um erro ao destruir a sessão!"));
}

?>