<?php
require_once("UserDAO.php");
require_once("../Auth/sessao.php");
//http_response_code(400);

$obj = json_decode(file_get_contents('php://input'));
var_dump($obj);
$verificaSessao = true;// verificaSessao($obj->Username, $obj->Chave);
if($verificaSessao){
    $user = UserDAO::getInstance()->retrieveByUsername($obj->Username);
    $user->setImage($obj->ImageInBase64);

    http_response_code(200);
    UserDAO::getInstance()->updateUser($user);
    echo json_encode(array("message" => "Usuário atualizado com sucesso."));
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "A sessão é inválida"));
}
?>