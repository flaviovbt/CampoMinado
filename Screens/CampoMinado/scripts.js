"use strict";

const operacoesNum = [
[-1, -1], [-1, 0], [-1, 1],
[0, -1],           [0, 1],
[1, -1],  [1, 0],  [1, 1],
];

var board = [], tabuleiro, fim = 0, campoMinado, tTrapaca, iniciou=0, numeroDeBombas=10, dimensoes='10x10', tempoAtual=0, timerLigado = true, modo="classico", m = 0, r=0; //fim define o fim do jogo
var xhttp; 

  var dimensao1 = parseInt(dimensoes.split("x")[0])
  var dimensao2 = parseInt(dimensoes.split("x")[1])

class CampoMinado {
    constructor(linhas, colunas, minas) {
        this.linhas = linhas;
        this.colunas = colunas;
        this.minas = minas;
        this.posicoes = [];

        this.inicio();
    }

    inicio() {
     
      this.criarTabuleiro();
    
      this.sortearMinas();
    
      this.inserirMinas();
  
      this.attNum();
    
      this.gerarTabela(this.linhas,this.colunas);
  
      this.gerarTrapaca(this.linhas,this.colunas);
    }

    gerarTabela(l, c) {
      var str = "";
      for (var i = 0; i < l; i++) {
          str += "<tr>";
          for (var j = 0; j < c; j++) {
              str += "<td class='blocked'></td>";
          }
          str += "</tr>";
      }
      tabuleiro.innerHTML = str;
    }

    criarTabuleiro() {
        for (var i = 0; i < this.linhas; i++) {
            board[i] = new Array(this.colunas).fill(0);
        }

    }



    sortearMinas() {
      this.posicoes = [];
      let i = 0


      while (this.posicoes.length < this.minas ) {
          i++
         
          const y = this.getRandomInt(0, this.linhas);
          const x = this.getRandomInt(0, this.colunas);

          if (!this.jaExiste([y, x])) {
              this.posicoes.push([y, x]);
          }

      }
    }


    getRandomInt(min, max) {        
        return Math.floor(Math.random() * (max - min)) + min;
    }

    jaExiste(posicao) {
        return this.posicoes.join(" ").includes(posicao.toString());
    }

    inserirMinas() {
      for (let i = 0; i < this.posicoes.length; i++) {
          const y = this.posicoes[i][0];
          const x = this.posicoes[i][1];
          board[y][x] = '*';
      }
    }

    attNum() {
      for (let i = 0; i < this.posicoes.length; i++) {
          for (let j = 0; j < operacoesNum.length; j++) {
              const posicao = this.posicoes[i];
              const operacao = operacoesNum[j];
              const boardY = posicao[0] + operacao[0];
              const boardX = posicao[1] + operacao[1];

              if (boardY >= 0 && boardY < this.linhas &&
                  boardX >= 0 && boardX < this.colunas &&
                  typeof board[boardY][boardX] === 'number') {
                  board[boardY][boardX]++;
              }
          }
      }
    }

    verificar(event) {
      var cell = event.target;
      if (cell.className == "blocked" && fim==0) {
          var linha = cell.parentNode.rowIndex;
          var coluna = cell.cellIndex;
          switch (board[linha][coluna]) {
              case '*':
                  cell.innerHTML = "&#128163;";
                  cell.style.backgroundColor = "red";;
                  gameOver();
                  alert("Você perdeu!");
                  timerLigado = false;
                  break;
              case 0:
                  limparCelulas(linha, coluna);
                  break;
              default:
                  cell.innerHTML = board[linha][coluna];
                  cell.className = "n" + board[linha][coluna];
          }
          fimDeJogo();
      }
    }

    bandeira(event) {
      if(fim==0){
        var cell = event.target;
        var linha = cell.parentNode.rowIndex;
        var coluna = cell.cellIndex;
        if (cell.className === "blocked") {
            cell.className = "flag";
            cell.innerHTML = "&#128681;";//&#9873;
        } else if (cell.className === "flag") {
            cell.className = "blocked";
            cell.innerHTML = "";
        }
        return false;
      }
    }

    gerarTrapaca(l,c){
      var str = "";
      for (var i = 0; i < l; i++) {
          str += "<tr>";
          for (var j = 0; j < c; j++) {
            switch (board[i][j]) {
                        case '*':str += "<td class='blanck'>"+ "&#128163;"+"</td>";
                            break;
                        case 0:
                            str += "<td class='blanck'>"+ "</td>";
                            break;
                        default:
                            var className = "n" + board[i][j];
                            str += "<td class="+ className + ">"+ board[i][j] +"</td>";
              }
          }
          str += "</tr>";
      }
      tTrapaca.innerHTML = str;
    }
}

function startGame(){
  verificaNumeroDeBombasEDimensoes()

  document.getElementById("sbt").style.display = "none";
  document.getElementById("tabela").style.display = "block";
  document.getElementById("rst").style.display = "flex";
  tabuleiro = document.getElementById("tabela");
  tTrapaca = document.getElementById("trapaca");
  document.getElementById("borda").style.display = "flex";
  document.querySelector(".headerGameArea").style.display = "flex";


  campoMinado = new CampoMinado(dimensao1,dimensao2,numeroDeBombas);//linhas, colunas, bombas :)
  
  tabuleiro.addEventListener('click',campoMinado.verificar);
  tabela.oncontextmenu = campoMinado.bandeira;
  trackTime();
  iniciou=1;
  r=0;
}

function gameOver(){
  mostrarMinas();
  fim=1;
  enviarBack();
}

function verificaNumeroDeBombasEDimensoes () {

  if (dimensao1 > 20) {
    dimensao1 = 20;
  }

  if (dimensao2 > 20) {
    dimensao2 = 20;
  }

  if (parseInt(dimensao1*dimensao2*0.9) > numeroDeBombas) {
    return 0;
  } else {
    
    document.getElementById("nbombas").value = parseInt(dimensao1*dimensao2*0.9);
    numeroDeBombas = parseInt(dimensao1*dimensao2*0.9);
    return -1;
  }
}

function mostrarMinas() {
    for (var i = 0; i < campoMinado.linhas; i++) {
        for (var j = 0; j < campoMinado.colunas; j++) {
            if (board[i][j] === '*') {
                var cell = tabuleiro.rows[i].cells[j];
                cell.innerHTML = "&#128163;";
                cell.className = "blank";
            }
        }
    }
}

function calculaTempoModoRivotril() {
  let tempo = -(numeroDeBombas*dimensao1*dimensao2)/3;
  return Math.round(tempo);
}

function restartGame(){

  verificaNumeroDeBombasEDimensoes()

  fim = 0;
  
  if (modo == 'rivotril') {
    tempoAtual = calculaTempoModoRivotril() || -120
  } else {
    tempoAtual = 0;
  }
  
  timerLigado = true;
  startGame();
}

function limparCelulas(l, c) {
    for (var i = l - 1; i <= l + 1; i++) {
        for (var j = c - 1; j <= c + 1; j++) {
            if (i >= 0 && i < campoMinado.linhas && j >= 0 && j < campoMinado.colunas) {
                var cell = tabuleiro.rows[i].cells[j];
                if (cell.className !== "blank") {
                    switch (board[i][j]) {
                        case '*':
                            break;
                        case 0:
                            cell.className = "blank";
                            limparCelulas(i, j);
                            break;
                        default:
                            cell.innerHTML = board[i][j];
                            cell.className = "n" + board[i][j];
                    }
                }
            }
        }
    }
}

function fimDeJogo() {
    var cells = document.querySelectorAll(".blocked, .flag");
    if (cells.length === campoMinado.minas && fim == 0) {
        r=1;
        gameOver();
        alert("Você venceu!");

        timerLigado = false;


        
    }
}

function forcarEncerramentoDoJogoTimeout() {
    gameOver();
    alert("O tempo acabou, você perdeu!");
    timerLigado = false;
}

function trapaca(){
  if(iniciou==1 && fim==0){
  tabuleiro.style.display = "none";
  tTrapaca.style.display = "flex";
  }
}

function normal(){
  if(iniciou==1 && fim==0){
  tabuleiro.style.display = "flex";
  tTrapaca.style.display = "none";
  }
}

function trackTime(){
  if (iniciou == 0) {

      if (modo == 'rivotril') {
    tempoAtual = calculaTempoModoRivotril() || -120
  } else {
    tempoAtual = 0;
  }

  setInterval(() => {
    if (timerLigado) {
    
    if (tempoAtual+1 != 0) {
      tempoAtual++
    } else {
      tempoAtual++
      forcarEncerramentoDoJogoTimeout();
    }

    document.getElementById("timer").innerHTML = tempoAtual < 0 ? tempoAtual*-1 : tempoAtual;
    }

  }, 1000)
  }
}

function alteraModo() {
  switch (modo) {
    case 'classico':
      m=1;
      modo = 'rivotril'
      document.getElementById("modoRivotril").className = 'switchOn';
      document.getElementById("modoClassico").className = 'switchOff';
      break
    case 'rivotril':
      m=0;
      modo = 'classico'
      document.getElementById("modoRivotril").className = 'switchOff';
      document.getElementById("modoClassico").className = 'switchOn';
      break
  }
}


//Quando input muda ele altera o  os valores
var input0 = document.getElementById("nbombas")

input0.value = numeroDeBombas;

input0.addEventListener('input', function()
{
    if (parseInt(input0.value) <= 0  || Number.isNaN(parseInt(input0.value))) {
      

      input0.value = 1;
      numeroDeBombas = 1;

    } else {
      numeroDeBombas =  parseInt(input0.value);
    }
    verificaNumeroDeBombasEDimensoes()
    if (parseInt(dimensao1*dimensao2*0.9) < parseInt(input0.value)) {
     
      input0.value = parseInt(dimensao1 * dimensao2*0.9)
      numeroDeBombas = parseInt(dimensao1 * dimensao2*0.9)
    } else {
      
      numeroDeBombas =  parseInt(input0.value);
    }
    

});



var input1 = document.getElementById("dimensao1")

input1.value = dimensao1;

input1.addEventListener('input', function()
{
  if (parseInt(input1.value) <= 1  || Number.isNaN(parseInt(input1.value))) {
      //alert("Número invalido de dimensões.")
      input1.value =  2
  } else {
    dimensao1 = parseInt(input1.value);
  }

  if (parseInt(input1.value) >= 20) {
     //alert("Número invalido de dimensões.")
      input1.value =  20
  } else {
    dimensao1 = parseInt(input1.value);
  }
});


var input2 = document.getElementById("dimensao2")

input2.value = dimensao2;

input2.addEventListener('input', function()
{
  if (parseInt(input2.value) <= 1  || Number.isNaN(parseInt(input2.value))) {
      //alert("Número invalido de dimensões.")
      input2.value =  2
  } else {
    dimensao2 = parseInt(input2.value);
  }

  if (parseInt(input2.value) >= 20 ) {
      //alert("Número invalido de dimensões.")
      input2.value =  20
  } else {
    dimensao2 = parseInt(input2.value);
  }

});

function enviarBack(){
  xhttp = new XMLHttpRequest();
  if (!xhttp) {
  alert('Não foi possível criar um objeto XMLHttpRequest.');
  return false;
  }

  xhttp.onreadystatechange = mostraResposta;
  xhttp.open('POST', 'back.php', true);
  xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhttp.send('dados=' + encodeURIComponent(JSON.stringify({colunas : dimensao1, linhas : dimensao2,bombas : numeroDeBombas, modo : m,tempo : tempoAtual, resultado : r})));

}

function mostraResposta() {
  try {
    if (xhttp.readyState === XMLHttpRequest.DONE) {
      if (xhttp.status === 200) {
      //alert("colunas: " + resposta.colunas + " linhas: " + resposta.linhas + " bombas: " + resposta.bombas + " modalidade: " + (resposta.modo == 0 ? 'classico' : 'rivotril') + " tempo: " + resposta.tempo + "  resultado: " + (resposta.resultado == 0 ? "perdeu" : "ganhou") +  " pontuação: " + resposta.pontos);
      }
      else {
        let resposta = JSON.parse(xhttp.responseText);
        alert(`Um problema ocorreu ${resposta.message}`);
      }
    }
  }
  catch (e) {
    alert("Ocorreu uma exceção:" + e);
    console.log(e);
  }
}

//Código adaptado de: https://dev.to/manussakis/como-criar-um-tabuleiro-de-campo-minado-em-javascript-26gf