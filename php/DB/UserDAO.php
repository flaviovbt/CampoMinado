<?php
require_once("DAO.php");
require_once("User.php");

class UserDAO extends DAO{
    private static $instance;

    private function __construct(){
        DAO::getConnection();
        DAO::createTable();
    }

    public static function getInstance(){
        return isset(self::$instance) ? self::$instance : self::$instance = new UserDAO();
    }

    public function insertNewUser($nome, $cpf, $dtNasc, $tel, $email, $username, $password){
        try{
            $stmt = DAO::getConnection()->prepare("INSERT INTO User (Nome, Cpf, Data_nascimento, Telefone, Email, Username, Password) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute(array($nome, $cpf, $dtNasc, $tel, $email, $username, $password));
        }
        catch(PDOException $e){
            $errorMessage = $e->getMessage();
            if(strpos(strtolower($errorMessage),"cpf")){
                throw new Exception("O CPF solicitado já foi cadastrado no sistema.");
            }
            else if(strpos(strtolower($errorMessage), "username")){
                throw new Exception("O Username solicitado já foi cadastrado no sistema.");
            }
            else if(strpos(strtolower($errorMessage), "email")){
                throw new Exception("O Email solicitado já foi cadastrado no sistema.");
            }
            else
                throw new Exception("Insert into Table User failed: {$e->getMessage()}");
        }
        return $this->retrieveById(DAO::lastId("User", "Id_user"));
    }

    private function buildObject($rs){
        $user = null;
        try{
            $user = new User($rs["Id_user"], $rs["Nome"], $rs["Cpf"], $rs["Data_nascimento"], $rs["Telefone"], $rs["Email"], $rs["Username"], $rs["Password"], $rs["Image"]);
        }
        catch(PDOException $e){
            throw new Exception("Build Object User Failed: {$e->getMessage()}");
        }
        return $user;
    }

    private function retrieveByQuery($query){
        $users = array();
        try{
            $rs = DAO::getResultSet($query);
            while($row = $rs->fetch(PDO::FETCH_ASSOC)){
                array_push($users, $this->buildObject($row));
            }
        }
        catch(PDOException $e){
            throw new Exception("Retrieve From Table User Failed: {$e->getMessage()}");
        }
        return $users;
    }

    public function retrieveById($id){
        $query = "SELECT * FROM User WHERE Id_user = $id";
        $user = $this->retrieveByQuery($query);
        return (empty($user) ? NULL : $user[0]);
    }

    public function retrieveByUsername($username){
        $query = "SELECT * FROM User WHERE Username LIKE '" . $username . "'";
        $user = $this->retrieveByQuery($query);
        return (empty($user) ? null : $user[0]);
    }

    public function updateUser($User){
        try{
            $stmt = DAO::getConnection()->prepare("UPDATE User SET Nome=?, Data_nascimento=?, Telefone=?, Email=?, Password=?, Image=? WHERE Id_user = ?");
            $stmt->execute(array($User->getNome(), $User->getDtNasc(), $User->getTelefone(), $User->getEmail(), $User->getPassword(), $User->getImage(), $User->getId()));
        }
        catch(PDOException $e){
            $errorMessage = $e->getMessage();
            if(strpos(strtolower($errorMessage),"email")){
                throw new Exception("O Email solicitado já foi cadastrado no sistema.");
            }
            throw new Exception("Update On Table User Failed: {$e->getMessage()}");
        }
    }
}
?>