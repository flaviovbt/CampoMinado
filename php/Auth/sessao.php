<?php

    function gerarChave ($length = 2) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
    
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = Rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
    
        $result .= date('dmYhis');

        return $result;
    }


function criarSessao ($username) {

    $chave = gerarChave();

    session_id($username);
    session_start();
    //echo session_id();
    $_SESSION["chave"] = $chave;
    //echo "<pre>", print_r($_SESSION, 1), "</pre>";
    session_write_close();

    return $chave;
}

function verificaSessao ($username, $chave) {

    $chaveValida = false;

    session_id($username);
    session_start();
    if ($_SESSION['chave'] === $chave)
        $chaveValida = true;
    else
        $chaveValida = false;
    session_write_close();

    return $chaveValida;
    
}

function destruirSessao ($username, $chave) {
    if (verificaSessao($username, $chave)) {
        session_id($username);
        session_start();
        $result = session_destroy();
        return $result;
    }
}

function sessaoValida(){
    if(!isset($_COOKIE['usuario']) || !isset($_COOKIE['chave']) || !verificaSessao($_COOKIE['usuario'], $_COOKIE['chave'])){
        http_response_code(401);
        header('Location: ../../index.html');
        exit() ;
    }
}
?>