"use strict";

function criaCookieDeSessao(nome, valor, expDateMs) {
    valor = encodeURI(valor);
  
    if (expDateMs) {
      var data = new Date(expDateMs);
      // Converte a data para GMT
      data = data.toGMTString();
      // Codifica o valor do cookie para evitar problemas
      // Cria o novo cookie
      document.cookie = nome + '=' + valor + '; expires=' + data + '; path=/';
    }
    else {
        document.cookie = nome + '=' + valor + '; path=/';
    }
}


function recuperaCookie(nome_cookie) {
    // Adiciona o sinal de = na frente do nome do cookie
    var cname = ' ' + nome_cookie + '=';
    
    // Obtém todos os cookies do documento
    var cookies = document.cookie;
    
    // Verifica se seu cookie existe
    if (cookies.indexOf(cname) == -1) {
        return false;
    }
    
    // Remove a parte que não interessa dos cookies
    cookies = cookies.substr(cookies.indexOf(cname), cookies.length);

    // Obtém o valor do cookie até o ;
    if (cookies.indexOf(';') != -1) {
        cookies = cookies.substr(0, cookies.indexOf(';'));
    }
    
    // Remove o nome do cookie e o sinal de =v
    cookies = cookies.split('=')[1];
    
    // Retorna apenas o valor do cookie
    return decodeURI(cookies);
}


function eraseCookieFromAllPaths(name) {
  // This function will attempt to remove a cookie from all paths.
  var pathBits = location.pathname.split('/');
  var pathCurrent = ' path=';

  // do a simple pathless delete first.
  document.cookie = name + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT;';

  for (var i = 0; i < pathBits.length; i++) {
      pathCurrent += ((pathCurrent.substr(-1) != '/') ? '/' : '') + pathBits[i];
      document.cookie = name + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT;' + pathCurrent + ';';
  }
}

function destruirSessao () {
    let chave = recuperaCookie("chave");
    let usuario = recuperaCookie("usuario");

    if (!chave || !usuario) {

        window.location.href = "../../index.html";
         
    }

    let ajax = new XMLHttpRequest();
    let json = JSON.stringify({Username: usuario, Chave: chave});

    ajax.open("POST", "../../php/Auth/destruirSessao.php");
    ajax.addEventListener('readystatechange', (ev) => {
      let ajax = ev.target;

      if(ajax.readyState === XMLHttpRequest.DONE){
        if(ajax.status === 200){
            eraseCookieFromAllPaths("usuario")
            eraseCookieFromAllPaths("chave")
            eraseCookieFromAllPaths("PHPSESSID")
            window.location.href = "../../index.html";
        } else {
            console.log("Ocorreu um erro ao destruir a sessão")
        }
      }
    });
    ajax.setRequestHeader('Content-Type', 'application/json');
    ajax.send(json);
}

export {criaCookieDeSessao, destruirSessao, recuperaCookie};