"use strict";

//Inicio partidas

var partidas = []

function getRanking(){
  let ajax = new XMLHttpRequest();
  ajax.open("POST", "../../php/DB/getRanking10.php");

  ajax.addEventListener('readystatechange', (ev) => {

    let ajax = ev.target;

    if(ajax.readyState === XMLHttpRequest.DONE){
      if(ajax.status === 200){
        partidas = JSON.parse(ajax.responseText);
        setPage(partidas.sort(comparePoints), 1);
      }
      else{
        let responseData = JSON.parse(ajax.responseText);
        alert(responseData.message);
      }
    }

  });
  ajax.setRequestHeader('Content-Type', 'application/json');
  ajax.send();
}

document.addEventListener("DOMContentLoaded", function () {
  getRanking();
  // create and manipulate your DOM here. doAjaxThings() will run asynchronously and not block your DOM rendering
  //document.createElement("...");
  //document.getElementById("...").addEventListener(...);
});

//Fim Partidas
//Inicio order

const comparePoints = (d1, d2) => {
  let d1Rate = parseInt(d1.points); 
  let d2Rate = parseInt(d2.points);

  if(d1Rate < d2Rate)
      return 1;
      
  else if(d1Rate > d2Rate)
      return -1;
  
  return 0;
}

//Fim order

const $ = (selector, startNode = document) => startNode.querySelector(selector);
const tabelaRanking = $('.tabelaRankingGlobal').getElementsByTagName('tbody')[0];

const printPartidasOnHtml = (data, init, end) => {
    
  let slicedData;

    if (init !==null && end !== null)
      slicedData = data.slice(init, end);

    slicedData.map((item, index) => {

      if (index == 0) {
      tabelaRanking.insertAdjacentHTML('beforeend', `<tr class="trContent"> <td> <div class="boxTdFirst">#${index+1}</div></td><td> <div class="boxTdFirst">${item.username}</div></td><td> <div class="boxTdFirst">${item.grid}</div></td><td> <div class="boxTdFirst">${item.tempo}</div></td><td> <div class="boxTdFirst">${item.points}</td></div></tr>`);
      } else {    
      tabelaRanking.insertAdjacentHTML('beforeend', `<tr class="trContent"> <td> <div class="boxTd">#${index+1}</div></td><td> <div class="boxTd">${item.username}</div></td><td> <div class="boxTd">${item.grid}</div></td><td> <div class="boxTd">${item.tempo}</div></td><td><div class="boxTd">${item.points}</div></td> </tr>`);
      }
    })
}

const setPage = (data, number) => {
  //Adiciona dados a tabela
  printPartidasOnHtml(data, (number*10)-10, number*10)
}

// //Carrega primeira pagina
// window.addEventListener('load',setPage(partidas.sort(comparePoints), 1))