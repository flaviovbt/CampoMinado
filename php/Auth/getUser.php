<?php
require_once("../DB/UserDAO.php");
require_once("sessao.php");

$obj = json_decode(file_get_contents('php://input'));


$user = UserDAO::getInstance()->retrieveByUsername($obj->Username);
$chave = $obj->Chave;

$verificaSessao = verificaSessao($obj->Username , $chave);

if ($verificaSessao)  {
    http_response_code(201);
    echo json_encode(array("id" => $user->getId(), "nome" => $user->getNome(), "cpf"=> $user->getCpf(),"email" => $user->getEmail(),"dataNasc" => $user->getDtNasc(),"telefone" => $user->getTelefone(),"password"=> $user->getPassword(), "username"=> $user->getUsername()));
    }
else{
    http_response_code(401);
    echo json_encode(array("message" => "A sessão é inválida"));
}

?>