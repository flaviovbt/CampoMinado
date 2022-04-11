"use strict";
import {Pessoa} from '../../scripts/pessoa.js';
import {recuperaCookie} from '../../scripts/session.js';

function correcao(form){
  
var allElements = form.elements;
  for (var i = 0, l = allElements.length; i < l; ++i) {
        allElements[i].disabled=false;
  }
  return true;
}



function resgatarPessoaDaSessao() {
  let localUserData = localStorage.getItem('usuario');
  let localUserDataJSON = JSON.parse(localUserData);

    let pessoa = new Pessoa(parseInt(localUserDataJSON.id), localUserDataJSON.nome, localUserDataJSON.email, localUserDataJSON.dataNasc, parseInt(localUserDataJSON.telefone), localUserDataJSON.username);
    return pessoa
}

const setImageOnScreen = (imgInBase64) => {

  let img = document.querySelector(".posicionamento .fotoPerfil");
  img.src = imgInBase64;
  img.height = 230;
  img.width = 230; 

}



const getImageFromDB = () => {

  
  let ajax = new XMLHttpRequest();
  let cookieUsuario = recuperaCookie('usuario');
  let cookieChave = recuperaCookie('chave');
  ajax.open("POST", "../../php/DB/getImage.php");

  let json = JSON.stringify({ Username: cookieUsuario, Chave: cookieChave });

  ajax.addEventListener('readystatechange', (ev) => {
      let ajax = ev.target;
      if (ajax.readyState === XMLHttpRequest.DONE) {

        var responseData = ajax.responseText;

        if (ajax.status === 200){
          if(ajax.responseText.length > 40)
            setImageOnScreen(ajax.responseText);
        }
        //alert(responseData.message);
      }
    });

    ajax.setRequestHeader('Content-Type', 'application/json');
    ajax.send(json);

}

function Preencher(){
  let pessoa = resgatarPessoaDaSessao()
  document.getElementById("nome").value = pessoa.getNome() 
  document.getElementById("dtNas").value = pessoa.getDataDeNascimento() 
  document.getElementById("telefone").value = pessoa.getTelefone() 
  document.getElementById("email").value = pessoa.getEmail() 
  getImageFromDB()
}

function salvaPessoaNaSessao (pessoa) {
  let pessoaOld = resgatarPessoaDaSessao()
  let id = pessoa.getId() || pessoaOld.getId();
  let nome = pessoa.getNome() || pessoaOld.getNome();
  let dataNasc = pessoa.getDataDeNascimento() || pessoaOld.getDataDeNascimento();
  let email = pessoa.getEmail() || pessoaOld.getEmail();
  let username = pessoa.getUsername() || pessoaOld.getUsername();
  let telefone = pessoa.getTelefone() || pessoaOld.getTelefone;

  let objPessoa = {id, nome, dataNasc, telefone, email, username};

  localStorage.setItem('usuario', JSON.stringify(objPessoa));
}

function atualizarDadosNaSessao(){
  let pessoa = resgatarPessoaDaSessao()

  let nome1 = document.getElementById("nome").value
  let dataDeNascimento1 = document.getElementById("dtNas").value
  let telefone1 = document.getElementById("telefone").value
  let email1 = document.getElementById("email").value
  let senhaInput = document.getElementById('senha').value
  let confirmarSenhaInput = document.getElementById('confirmarSenha').value
  if(senhaInput !== confirmarSenhaInput ){
    return alert ("Senhas não identicas.")
  }
  let password1 = document.getElementById("senha").value

  pessoa.setNome(nome1)
  pessoa.setDataDeNascimento(dataDeNascimento1)
  pessoa.setTelefone(telefone1)
  pessoa.setEmail(email1)

 
  

  let ajax = new XMLHttpRequest();
  let cookieUsuario = recuperaCookie('usuario');
  let cookieChave = recuperaCookie('chave')
  let json = JSON.stringify({Nome: pessoa.getNome(), DtNasc: pessoa.getDataDeNascimento(), Telefone: pessoa.getTelefone(), Email: pessoa.getEmail(), Password: password1, Username: cookieUsuario, Chave: cookieChave });

  ajax.open("POST", "../../php/DB/updateUser.php");
  ajax.addEventListener('readystatechange', (ev) => {
      let ajax = ev.target;
      if (ajax.readyState === XMLHttpRequest.DONE) {
        var responseData = JSON.parse(ajax.responseText);
    
        if (ajax.status === 200){
          salvaPessoaNaSessao(pessoa);
        }
        alert(responseData.message);
      }
    });

    ajax.setRequestHeader('Content-Type', 'application/json');
    ajax.send(json);  

  //alert("Dados atualizados com sucesso!")
}

//Quando clicar 

document.getElementById("lapisNome").addEventListener("click", function(){ 
  document.getElementById("nome").disabled = false; 
});

document.getElementById("lapisDtNas").addEventListener("click", function(){ 
  document.getElementById("dtNas").disabled = false; 
});

document.getElementById("lapisTelefone").addEventListener("click", function(){ 
  document.getElementById("telefone").disabled = false; 
});

document.getElementById("lapisEmail").addEventListener("click", function(){ 
  document.getElementById("email").disabled = false; 
});

document.getElementById("lapisSenha").addEventListener("click", function(){ 
  document.getElementById("senha").disabled = false; 
  document.getElementById("confirmarSenha").disabled = false;
});

document.getElementById("enviar").addEventListener("click", function(event){
   atualizarDadosNaSessao();
});


Preencher();






//Inserindo novas imagens em cache adaptado de <https://stackoverflow.com/questions/49349628/is-there-a-way-to-change-src-of-few-images-at-once-in-js>
const updateImage = (event) =>{
  if(event.target.files && event.target.files[0]){
    let img = document.querySelector(".posicionamento .fotoPerfil");


      var reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]);
      reader.onload = function () {


        let ajax = new XMLHttpRequest();
        let cookieUsuario = recuperaCookie('usuario');
        let cookieChave = recuperaCookie('chave');
        let ImageInBase64 = reader.result; 
        let json = JSON.stringify({ ImageInBase64: ImageInBase64 , Username: cookieUsuario, Chave: cookieChave });
      
        ajax.open("POST", "../../php/DB/updateImage.php");
        ajax.addEventListener('readystatechange', (ev) => {
            let ajax = ev.target;
            if (ajax.readyState === XMLHttpRequest.DONE) {
              console.log(ajax.responseText)
              //var responseData = JSON.parse(ajax.responseText);
              if (ajax.status === 200){
                  //alert(responseData.ImageInBase64)
                  img.src = ImageInBase64;
                  img.height = 230;
                  img.width = 230;
              }
              //alert(responseData.message);
            }
          });
      
          ajax.setRequestHeader('Content-Type', 'application/json');
          ajax.send(json);
      

      };
      reader.onerror = function (error) {
        console.log('Error: ', error);
      };
   

 

  }
}





let insertImage = document.getElementById("image");
insertImage.addEventListener("change", updateImage);

