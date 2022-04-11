<?php
require ('PartidaDAO.php');
require ('UserDAO.php');

$obj = json_decode(file_get_contents('php://input'));

$userId = $obj->UserId;

$arr = array();

$arr = PartidaDAO::getInstance()->retrieveByIdUser($userId);

$returnArr = array();

if(!empty($arr)) {

    foreach ($arr as $row => $value){
        array_push($returnArr, array(
            'id'=>$value->getIdPartida(),
            'data'=>$value->getData(),
            'bombas'=>$value->getBombas(),
            'grid'=>$value->getGridLin().'x'.$value->getGridCol(),
            'modalidade'=>$value->getModalidade()?'Rivotril':'Clássico',
            'tempo'=>$value->getTempo(),
            'resultado'=>$value->getResultado()?'Vitória':'Derrota',
            'points'=>$value->getPontuacao()
        ));
    }

    http_response_code(200);
    echo json_encode($returnArr);
}
else{
    http_response_code(204);
    echo json_encode(array("message" => "Não foi possível retornar o histórico"));
}

?>