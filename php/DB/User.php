<?php 
class User{

    private $id;
    private $nome;
    private $cpf;
    private $dtNasc;
    private $telefone;
    private $email;
    private $username;
    private $password;
    private $image;
    

    public function __construct($id, $nome, $cpf, $dtNasc, $telefone, $email, $username, $password, $image)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->dtNasc = $dtNasc;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->image = $image;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getDtNasc()
    {
        return $this->dtNasc;
    }

    public function setDtNasc($dtNasc)
    {
        $this->dtNasc = $dtNasc;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
}
?>