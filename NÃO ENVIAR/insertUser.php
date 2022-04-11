<?php 

    $serverName = "localhost";
    $userName = "root";
    $pwd = "";
    $dbName = "campoMinado";

    try {
        $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $pwd);

        $query = "INSERT INTO USER VALUES (1, 'Marcio', 99199299599, '2021-01-21', 40028922, 'marcio@gmail.com', 'marcin', '123')";

        $conn->exec($query);
    } catch (PDOException $e) {
        echo "Connection Failed: {$e->getMessage()}";
    }
?>