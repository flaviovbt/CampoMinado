<?php
require_once("UserDAO.php");
require_once("../Auth/sessao.php");
//http_response_code(400);

$obj = json_decode(file_get_contents('php://input'));


$user = UserDAO::getInstance()->retrieveByUsername($obj->Username);
$chave = $obj->Chave;

$verificaSessao = verificaSessao($obj->Username , $chave);

if ($verificaSessao)  {
    http_response_code(200);
    echo $user->getImage();
    }
else{
    http_response_code(401);
    echo json_encode(array("message" => "A sessão é inválida"));
}

?>