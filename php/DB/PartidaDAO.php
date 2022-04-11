<?php
require_once("DAO.php");
require_once("Partida.php");

class PartidaDAO extends DAO{
    private static $instance;

    private function __construct(){
        DAO::getConnection();
        DAO::createTable();
    }

    public static function getInstance(){
        return isset(self::$instance) ? self::$instance : self::$instance = new PartidaDAO();
    }

    public function insertNewPartida($idUser, $gridCol, $gridLin, $bombas, $data, $modalidade, $tempo, $pontuacao, $resultado){
        try{
            $stmt = DAO::getConnection()->prepare("INSERT INTO Partidas (Id_user, Grid_Col, Grid_Lin, Bombas, Data, Modalidade, Tempo, Pontuacao, Resultado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute(array($idUser, $gridCol, $gridLin, $bombas, $data, $modalidade, $tempo, $pontuacao, $resultado));
        }
        catch(PDOException $e){
            $errorMessage = $e->getMessage();
            if(strpos(strtolower($errorMessage),"id__user")){
                throw new Exception("O ID de Usuario especificado não existe");
            }
            throw new Exception("Insert Into Table Partidas Failed: {$e->getMessage()}");
        }
        return $this->retrieveById(DAO::lastId("Partidas", "Id_partida"));
    }

    private function buildObject($rs){
        $partida = null;
        try{
            $partida = new Partida($rs["Id_user"], $rs["Id_partida"], $rs["Grid_Col"], $rs["Grid_Lin"], $rs["Bombas"], $rs["Data"], $rs["Modalidade"], $rs["Tempo"], $rs["Pontuacao"], $rs["Resultado"]);
        }
        catch(PDOException $e){
            throw new Exception("Build Object Partida Failed: {$e->getMessage()}");
        }
        return $partida;
    }

    private function retrieveByQuery($query){
        $partidas = array();
        try{
            $rs = DAO::getResultSet($query);
            while($row = $rs->fetch(PDO::FETCH_ASSOC)){
                array_push($partidas, $this->buildObject($row));
            }
        }
        catch(PDOException $e){
            throw new Exception("Retrieve From Table Partidas Failed: {$e->getMessage()}");
        }
        return $partidas;
    }
    public function retrieveAll(){
        $query = "SELECT * FROM Partidas";
        $partidas = $this->retrieveByQuery($query);
        return (empty($partidas) ? null : $partidas);
    }
 
    public function retrieveByIdUser($idUser){
        $query = "SELECT * FROM Partidas WHERE Id_user = $idUser";
        $partidas = $this->retrieveByQuery($query);
        return (empty($partidas) ? null : $partidas);
    }

    public function retrieveById($idPartida){
        $query = "SELECT * FROM Partidas WHERE Id_partida = $idPartida";
        $partida = $this->retrieveByQuery($query);
        return (empty($partida) ? null : $partida[0]);
    }

    public function updatePartida($Partida){
        try{
            $stmt = DAO::getConnection()->prepare("UPDATE Partidas SET Grid_Col=?, Grid_Lin=?, Bombas=?, Data=?, Modalidade=?, Tempo=?, Pontuacao=?, Resultado=?, WHERE Id_Partida = ? AND Id_User = ?");
            $stmt->execute(array($Partida->getGridCol(), $Partida->getGridLin(), $Partida->getBombas(), $Partida->getData(), $Partida->getModalidade(), $Partida->getTempo(), $Partida->getPontuacao(), $Partida->getResultado(), $Partida->getIdPartida(), $Partida->getIdUser()));
        }
        catch(PDOException $e){
            throw new Exception("Update On Table Partidas Failed: {$e->getMessage()}");
        }
    }

    public function retrieveTopDez(){
        $query = "SELECT * FROM Partidas ORDER BY Pontuacao DESC LIMIT 10";
        $partida = $this->retrieveByQuery($query);
        return (empty($partida) ? null : $partida);
    }
}
?>