<?php
require ('PartidaDAO.php');
require ('UserDAO.php');


$arr = array();

$arr = PartidaDAO::getInstance()->retrieveTopDez();

$returnArr = array();

if(!empty($arr)) {

    foreach ($arr as $row => $value){

        $nomeUsuario=UserDAO::getInstance()->retrieveById($value->getIdUser())->getUsername();

        array_push($returnArr, array(
            'username'=>$nomeUsuario,
            'id'=>$value->getIdPartida(),
            'data'=>$value->getData(),
            'bombas'=>$value->getBombas(),
            'grid'=>$value->getGridLin().'x'.$value->getGridCol(),
            'modalidade'=>$value->getModalidade(),
            'tempo'=>$value->getTempo(),
            'resultado'=>$value->getResultado(),
            'points'=>$value->getPontuacao()
        ));
    }

    http_response_code(200);
    echo json_encode($returnArr);
}
else{
    http_response_code(204);
    echo json_encode(array("message" => "Não foi possível retornar o ranking"));
}

?>