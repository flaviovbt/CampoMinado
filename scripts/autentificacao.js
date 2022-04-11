"use strict";
import {requisitarPessoa} from './pessoa.js';
import { criaCookieDeSessao } from './session.js';
import { validarCadastro } from './validadores.js';

var tela = 0;
document.querySelector("a#logar").addEventListener('click', logar);
document.querySelector("a#cadastro").addEventListener('click', cadastrar);
let elementoSwitch = document.querySelectorAll("a.trocaTela");
elementoSwitch.forEach(element => {
  element.addEventListener('click', trocarTela);
});

function trocarTela() {
  if (tela == 0) {
    document.getElementById("cadastrar").style.display = "flex";
    document.getElementById("entrar").style.display = "none";
    tela = 1;
  } else {
    document.getElementById("cadastrar").style.display = "none";
    document.getElementById("entrar").style.display = "flex";
    tela = 0;
  }
}

function cadastrar() {
    let usernameInput = document.getElementById('usuario').value
    let nomeInput = document.getElementById('nome').value
    let cpfInput = document.getElementById('cpf').value
    let emailInput = document.getElementById('email').value
    let dataNascInput = document.getElementById('dataNasc').value
    let telefoneInput = document.getElementById('telefone').value
    let senhaInput = document.getElementById('senha').value
    let confirmmarSenhaInput = document.getElementById('confirmarSenha').value

    let cadastroValido = validarCadastro(document.formCad)
    if(cadastroValido){
      let ajax = new XMLHttpRequest();
      let json = JSON.stringify({Username: usernameInput, Nome: nomeInput, Cpf: cpfInput, Email: emailInput, DataNasc: dataNascInput, Telefone: telefoneInput, Senha: senhaInput});

      ajax.open("POST", "php/DB/createUser.php");
      ajax.addEventListener('readystatechange', (ev) => {

        let ajax = ev.target;

        if(ajax.readyState === XMLHttpRequest.DONE){
          if(ajax.status === 200){
            trocarTela();
          }
          else{
            let responseData = JSON.parse(ajax.responseText);
            alert(responseData.message);
          }
        }
      });
      ajax.setRequestHeader('Content-Type', 'application/json');
      ajax.send(json);
  }
}

  function logar() {
    let usuario = document.getElementById("usuarioLogin").value;
    let senha = document.getElementById("senhaLogin").value;
  
    let json = JSON.stringify({ Username: usuario, Password: senha });
    let ajax = new XMLHttpRequest();
  
    //Qual requisicao sera feita e para onde
    ajax.open("POST", "php/Auth/login.php");
  
    //metodo chamado quando a requisicao for concluida
    ajax.addEventListener('readystatechange', (ev) => {

        let ajax = ev.target;
        if (ajax.readyState === XMLHttpRequest.DONE) {
      
          var responseData = JSON.parse(ajax.responseText);
      
          if (ajax.status === 201){
            criaCookieDeSessao("usuario", responseData.usuario, responseData.expDateMs);
            criaCookieDeSessao("chave", responseData.chave, responseData.expDateMs);
            requisitarPessoa(responseData.chave, responseData.usuario)
          }
          else
            alert(responseData.message);
        }
    });
  
    //tipo de header que sera enviado na requisicao
    ajax.setRequestHeader('Content-Type', 'application/json');
  
    //envio de requisicao
    ajax.send(json);  
}

export{trocarTela};