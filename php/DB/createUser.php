<?php 
    require_once("DAO.php");
    require_once("UserDAO.php");

    $obj = json_decode(file_get_contents('php://input'));
    try{
        $user = UserDAO::getInstance()->insertNewUser($obj->Nome, $obj->Cpf, $obj->DataNasc, $obj->Telefone, $obj->Email, $obj->Username, $obj->Senha);
        http_response_code(200);
    }
    catch(Exception $e){
        http_response_code(500);
        echo json_encode(array("message" => "Houve um erro ao tentar realizar o cadastro: {$e->getMessage()}"));   
    }
?>