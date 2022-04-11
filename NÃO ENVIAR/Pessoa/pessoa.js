// Validador de CPF adaptado de DevMedia https://www.devmedia.com.br/validar-cpf-com-javascript/23916
function cpfIsValid(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
  if (strCPF == "00000000000") return false;

  for (let i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

  Soma = 0;
    for (let i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}

function dataValida(strData){

    //Verifica se a data esta no padrão
    if(/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(strData)){
        
    }
    else{
        return false;
    }

    var divisao =  strData.split("/");
    var dia = parseInt(divisao[0], 10); 
    var mes = parseInt(divisao[1], 10);
    var ano = parseInt(divisao[2], 10);

    if(ano < 1900 || ano > new Date ().getFullYear() || mes == 0 || mes > 12){
        return false;
    }

    var diasDoMes = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    //Ano bixesto
    if(ano % 400 == 0 || (ano % 100 != 0 && ano % 4 == 0)){
        diasDoMes[1] = 29;
    }

    return dia > 0 && dia <= diasDoMes[mes - 1];
}


class Pessoa {
    constructor() {
      this.nome = '';
      this.cpf = '';
      this.email = '';
      this.dataDeNascimento = '';
      this.telefone = '';
      this.password = '';
      this.username = '';
     }

    getNome () {
      return this.nome;
    }
    getCpf(){
        return this.cpf;
    }
    getEmail(){
        return this.email;
    }
    getDataDeNascimento(){
        return this.dataDeNascimento;
    }
    getTelefone(){
        return this.telefone;
    }
    getPassword(){
        return this.password;
    }
    getUsername(){
        return this.username;
    }
    setNome(nomeUsuario){
        if(nomeUsuario == ""){
            alert("Nome inválido")
        }
        else{
        this.nome = nomeUsuario;  
        return this.nome
        }
    }
    setCpf(cpfUsuario){
        if(cpfIsValid(cpfUsuario)){
        this.cpf = cpfUsuario;
        }
        else{
            alert("cpfInvalido");
        }

    }
    setEmail(emailUsuario){
        if(emailUsuario.includes("@")){
        this.email = emailUsuario;
        }
        else{
            alert("Email Invalido")
        }
    }
    setDataDeNascimento(dataDeNascimentoUsuario){
        if(dataValida(dataDeNascimentoUsuario))
        {
        this.dataDeNascimento = dataDeNascimentoUsuario;
        }
        else{
            alert("Data Invalida")
        }
    }
    setTelefone(telefoneUsuario){
        if(telefoneUsuario == "" || telefoneUsuario.length < 10){
            alert("Telefone inválido")
        }
        else{
        this.telefone = telefoneUsuario;  
        return this.telefone
        }
    }

    setPassword(passwordUsuario){
        this.password = passwordUsuario;
    }
    setUsername(usernameUsuario){
        this.username = usernameUsuario;
    }
}

export default Pessoa; 