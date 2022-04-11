<?php
abstract class DAO{

    public static $serverName = "localhost";
    public static $userName = "root";
    public static $pwd = "";
    public static $dbname = "campoMinado";

    private static $conn;

    protected static function getConnection(){
        if(self::$conn == null){
            try{
                $serverName = self::$serverName;
                $userName = self::$userName;
                $dbname = self::$dbname;
                $pwd = self::$pwd;

                self::createDB($serverName, $userName, $pwd, $dbname);

                self::$conn = new PDO("mysql:host=$serverName; dbname=$dbname", $userName, $pwd);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                die("Connection Failed: {$e->getMessage()}");
            }
        }
        return self::$conn;    
    }

    private static function createDB($serverName, $userName, $pwd, $dbname){
        $conn = new mysqli($serverName, $userName, $pwd);

        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $result = $conn->query($sql);

        if($result == false)
            throw new Exception("Create Database Error");
    }

    protected function getResultSet($query){
        try{
            $rs = self::getConnection()->query($query);
        }
        catch(PDOException $e){
            die("Get ResultSet Failed: {$e->getMessage()}");
        }
        return $rs;
    }
    
    protected function lastId($table, $primaryKey){
        $lastId = -1;
        try{
            $rs = self::getConnection()->query("SELECT MAX($primaryKey) AS $primaryKey FROM $table");
            $lastId = $rs->fetch(PDO::FETCH_ASSOC); 
        }
        catch(PDOException $e){
            die("Retrieve Last Id Failed: {$e->getMessage()}");
        }
        return $lastId[$primaryKey];
    }

    protected function executeUpdate($query){
        $update = self::getConnection()->exec($query);
        return $update;
    }

    protected final function createTable(){
        try{
            $query = "CREATE TABLE IF NOT EXISTS User(
                Id_user INT NOT NULL AUTO_INCREMENT,
                Nome VARCHAR(120) NOT NULL,
                Cpf CHAR(11) NOT NULL,
                Data_nascimento VARCHAR(10) NOT NULL,
                Telefone CHAR(15) NOT NULL,
                Email VARCHAR(70) NOT NULL,
                Username VARCHAR(120) NOT NULL,
                Password VARCHAR(120) NOT NULL,
                Image LONGTEXT NULL,
                UNIQUE (Email),
                UNIQUE (Cpf),
                UNIQUE (Username),
                PRIMARY KEY(Id_user)
            )";
            self::executeUpdate($query);
            $query = "CREATE TABLE IF NOT EXISTS Partidas(
                Id_user INT NOT NULL,
                Id_partida INT NOT NULL AUTO_INCREMENT,
                Grid_Col INT NOT NULL,
                Grid_Lin INT NOT NULL,
                Bombas INT NOT NULL,
                Data VARCHAR(10) NOT NULL,
                Modalidade VARCHAR(8),
                Tempo INT NOT NULL,
                Pontuacao INT NOT NULL,
                Resultado BOOLEAN NOT NULL,
                FOREIGN KEY (Id_user) REFERENCES User(Id_user),
                PRIMARY KEY (Id_partida)
            )";
            self::executeUpdate($query);
        }
        catch(PDOException $e){
            die("Create Table Failed: {$e->getMessage()}");
        }
    }
}
?>