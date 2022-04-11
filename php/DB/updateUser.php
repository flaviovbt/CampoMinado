<?php
require_once("UserDAO.php");
require_once("../Auth/sessao.php");
//http_response_code(400);

$obj = json_decode(file_get_contents('php://input'));

$verificaSessao = verificaSessao($obj->Username, $obj->Chave);
if($verificaSessao){
    $user = UserDAO::getInstance()->retrieveByUsername($obj->Username);
    $user->setNome($obj->Nome);
    $user->setDtNasc($obj->DtNasc);
    $user->setEmail($obj->Email);
    $user->setTelefone($obj->Telefone);

    if (!empty($obj->Password))
        $user->setPassword($obj->Password);

    http_response_code(200);
    UserDAO::getInstance()->updateUser($user);
    echo json_encode(array("message" => "Usuário atualizado com sucesso."));
}
else{
    http_response_code(500);
    echo json_encode(array("message" => "A sessão é inválida"));
}
?>