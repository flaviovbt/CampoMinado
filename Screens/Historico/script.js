"use strict";

//Area de partidas

var partidas = []

function getHistorico(){
  let ajax = new XMLHttpRequest();
  let UsuarioLocalStorage = localStorage.getItem('usuario');

  let UserId = JSON.parse(UsuarioLocalStorage).id;

  let json = JSON.stringify({UserId: UserId});

  ajax.open("POST", "../../php/DB/getHistorico.php");

  ajax.addEventListener('readystatechange', (ev) => {

    let ajax = ev.target;
    if(ajax.readyState === XMLHttpRequest.DONE){
      if(ajax.status === 200){
        partidas = JSON.parse(ajax.responseText);
        setPage(orderByDate(partidas,true), 1)
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

document.addEventListener("DOMContentLoaded", function () {
  getHistorico();
  // create and manipulate your DOM here. doAjaxThings() will run asynchronously and not block your DOM rendering
  //document.createElement("...");
  //document.getElementById("...").addEventListener(...);
});



//Fim Area de partidas

//Area ordenacoes

/**
 * @param {Boolean} type true: ordem decrescente, false: ordem crescente
 */
 const orderByDate = (data, type) => {
  //Ordem decrescente
  if(type)
      return data.sort(compareDate).reverse();
  //Ordem crescente
  else if(!type)
      return data.sort(compareDate);
  else
      throw "Invalid argument";
}

const orderByTime = (data, type) => {
  //Ordem decrescente
  if(type)
      return data.sort(compareTime).reverse();
  //Ordem crescente
  else if(!type)
      return data.sort(compareTime);
  else
      throw "Invalid argument";
}

const orderByBombs = (data, type) => {
  //Ordem decrescente
  if(type)
      return data.sort(compareBombs).reverse();
  //Ordem crescente
  else if(!type)
      return data.sort(compareBombs);
  else
      throw "Invalid argument";
}

const compareBombs = (d1, d2) => {
  if(parseInt(d1.bombas) < parseInt(d2.bombas))
      return -1;
  else if(parseInt(d1.bombas) > parseInt(d2.bombas))
      return 1;
  
  return 0;
}

const compareDate = (d1, d2) => {
  //Compara na ordem ano/mes/dia
  
  let d1Split = dateStrToInt(d1.data);
  let d2Split = dateStrToInt(d2.data);

  if(d1Split[2] < d2Split[2])
      return -1;
  else if(d1Split[2] > d2Split[2])
      return 1;

  if(d1Split[1] < d2Split[1])
      return -1;
  else if(d1Split[1] > d2Split[1])
      return 1;

  if(d1Split[0] < d2Split[0])
      return -1;
  else if(d1Split[0] > d2Split[0])
      return 1;
  
  return 0;  
}

const dateStrToInt = (date) => {
  let intDate = date.split('/').map(function(item) {
    return parseInt(item, 10);
  });
  return intDate;
}

const compareTime = (d1, d2) => {
  if(parseInt(d1.tempo) < parseInt(d2.tempo))
      return -1;
  else if(parseInt(d1.tempo) > parseInt(d2.tempo))
      return 1;
  
  return 0;
}

const comparePoints = (d1, d2) => {
  let d1Rate = parseInt(d1.points);
  let d2Rate = parseInt(d2.points);

  if(d1Rate < d2Rate)
      return 1;
      
  else if(d1Rate > d2Rate)
      return -1;
  
  return 0;
}

//Fim Area ordenacoes

const $ = (selector, startNode = document) => startNode.querySelector(selector);
const tabelaHistorico = $('.tabelaHistorico').getElementsByTagName('tbody')[0];
const botaoAvancar = $('.botaoAvancar');
const botaoVoltar = $('.botaoVoltar');
const ordenador = $('.dropdown-content');
const user = $('.userInfo');
let page = 1;

try {
  var nome = JSON.parse(localStorage.getItem('usuario')).username
} catch (err) {
  alert ("Ocorreu um erro ao recuperar o usuário da sessão.")
}


user.innerHTML = nome;

const cleanTable = () => {
    while (tabelaHistorico.rows.length > 1) {
     tabelaHistorico.deleteRow(1);
    }
}

const verifyPagination = (data, init, end) =>{
  if (data.slice(end, end+10) < 1)
    botaoAvancar.style.display = "none";

  else
    botaoAvancar.style.display = "block";

  if(data.slice(init-10, init) < 1)
    botaoVoltar.style.display = "none";

  else
    botaoVoltar.style.display = "block";
}

const printPartidasOnHtml = (data, init, end) => {
    let slicedData;

    if (init !==null && end !== null)
      slicedData = data.slice(init, end);

    //Verificacao da existencia de paginacao
    verifyPagination(data, init, end);
    
    //Limpa tabela
    cleanTable()


    slicedData.map((item, index) => {

      if (index == 0) {
      tabelaHistorico.insertAdjacentHTML('beforeend', `<tr class="trContent"> <td> <div class="boxTdFirst">${item.data}</div></td><td> <div class="boxTdFirst">${item.bombas}</div></td><td> <div class="boxTdFirst">${item.grid}</div></td><td> <div class="boxTdFirst">${item.modalidade}</div></td><td> <div class="boxTdFirst">${item.tempo}</div></td> <td> <div class="boxTdFirst">${item.points}</div></td> <td> <div class="boxTdFirst">${item.resultado}</div></td></tr>`);
      } else {     
      tabelaHistorico.insertAdjacentHTML('beforeend', `<tr class="trContent"> <td> <div class="boxTd">${item.data}</div></td><td> <div class="boxTd">${item.bombas}</div></td><td> <div class="boxTd">${item.grid}</div></td><td> <div class="boxTd">${item.modalidade}</div></td><td> <div class="boxTd">${item.tempo}</div></td> <td> <div class="boxTd">${item.points}</div></td><td> <div class="boxTd">${item.resultado}</div></td></tr>`);
      }
    })
}

const setPage = (data, number) => {
  //Adiciona dados a tabela
  printPartidasOnHtml(data, (number*10)-10, number*10)
}

// //Carrega primeira pagina
// window.addEventListener('load',setPage(orderByDate(partidas,true), 1))

botaoAvancar.onclick = function () {
  page++
  setPage(partidas , page)
};

botaoVoltar.onclick = function () {
  page--
  setPage(partidas, page)
};

ordenador.children[0].onclick = function(){
  orderByDate(partidas, true);
  setPage(partidas, page);
};

ordenador.children[1].onclick = function(){
  orderByDate(partidas, false);
  setPage(partidas, page);
};

ordenador.children[2].onclick = function(){
  orderByTime(partidas, false);
  setPage(partidas, page);
};

ordenador.children[3].onclick = function(){
  orderByBombs(partidas, true);
  setPage(partidas, page);
};

ordenador.children[4].onclick = function(){
  partidas.sort(comparePoints);
  setPage(partidas, page);
}