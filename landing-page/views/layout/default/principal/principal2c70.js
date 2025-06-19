$(window).on("load", function () {
	$('#page-loader').fadeOut(1000);
});
/*
let datNavProducto;
document.addEventListener(
  "DOMContentLoaded",
  () => {
    requestSand({
      url: geturl() + "productos/navProducto",
      method: "GET",
      dataType: "json",
      loadstart: (e) => {},
      success: (response) => {
        datNavProducto = response;
        const divList = document.querySelectorAll("#navDesktop li");
        divList.forEach(function (Item) {
          Item.addEventListener("mouseover", (event) => {
            pintarNavProducto(
              event.target.parentElement.getAttribute("data-id")
            );
          });
        });
      },
      error: (e) => {
        console.log("No se ha podido obtener la información.");
      },
      timeout: 6000,
    });
    
  },
  false
);
*/
$(function() {
  $(window).scroll(function() {
if ($(window).scrollTop() > 500) {
  $("#ui-to-top").addClass("active");//.fadeOut();
} else {
  $("#ui-to-top").removeClass("active");//.fadeIn();
}
  });
});
document.getElementById("ui-to-top").onclick = () => {
  $("html,body").animate({ scrollTop: 0 }, "slow");
};
/*
function pintarNavProducto(id) {
  datNavProducto.forEach((item) => {
    if (item[2] == id) {
      document.getElementById("textNavPro").href =
        geturl() + "productos/detalles/p" + item[0];
      document.getElementById("imageNavPro").src =
        geturl() + "temp/master/" + item[3];
      document.getElementById("textNavPro").innerHTML = item[1];
      return;
    }
  });
}*/
//const found = array1.find(element => element == 12);

function MayusPri(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

var get = function (url, callBack) {
  requestServer("get", url, callBack);
};

function requestServer(httpMethod, url, callBackMethod, form, text) {
  var xhr = new XMLHttpRequest();
  xhr.open(httpMethod, url, true);
  xhr.onreadystatechange = function () {
    if (xhr.status == 200 && xhr.readyState == 4) {
      callBackMethod(xhr.response);
    }
  };
  if (form == null) {
    if (text == null) xhr.send();
    else xhr.send(text);
  } else xhr.send(form);
}

function sendText(url, metodo, texto) {
  requestServer2("post", url, metodo, texto);
}
function requestServer2(httpMethod, url, callBackMethod, texto) {
  // xhttp =
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      callBackMethod(xhr.response);
    }
  };
  xhr.open(httpMethod, url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  if (texto != "") xhr.send("data=" + texto);
  else xhr.send();
}

function pad(n, length) {
  var n = n.toString();
  while (n.length < length) n = "0" + n;
  return n;
}

function MayusPri(string) {
  return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}

function numeroAleatorio(min, max) {
  return Math.round(Math.random() * (max - min) + min);
}

function formatMoneda(n, currency) {
  var n = n.replace(" ", "") * 1;
  return currency + "" + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}

function formatMonedaEs(n, currency) {
  var n = n.replace(" ", "") * 1;
  return (
    currency + " " + n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
  );
}
function removerAcentos(s) {
  var r = s.toLowerCase();
  //r = r.replace(new RegExp(/\s/g),"");
  r = r.replace(new RegExp(/[àáâãäå]/g), "a");
  //r = r.replace(new RegExp(/æ/g),"ae");
  //r = r.replace(new RegExp(/ç/g),"c");
  r = r.replace(new RegExp(/[èéêë]/g), "e");
  r = r.replace(new RegExp(/[ìíîï]/g), "i");
  //r = r.replace(new RegExp(/ñ/g),"n");
  r = r.replace(new RegExp(/[òóôõö]/g), "o");
  //r = r.replace(new RegExp(/œ/g),"oe");
  r = r.replace(new RegExp(/[ùúûü]/g), "u");
  //r = r.replace(new RegExp(/[ýÿ]/g),"y");
  //r = r.replace(new RegExp(/\W/g),"");
  return r;
}



function whatsappWeb(e) {
  let url = "https://api.whatsapp.com/send?phone=";
  //let numero = '51 ';
  let numero = "51" + document.getElementById("txtcelularw").value.trim();
  let messje = "Quiero%20realizar%20un%20pedido";
  window.open(url + numero + "&text=" + messje, "_blank");
}

function validarEmail(email) {
  expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (!expr.test(email)) return true;
  else return false;
}

class CampoNumerico {
  constructor(selector) {
    this.nodo = document.querySelector(selector);
    this.valor = "";

    this.empezarAEscucharEventos();
  }

  empezarAEscucharEventos() {
    this.nodo.addEventListener(
      "keydown",
      function (evento) {
        const teclaPresionada = evento.key;
        const teclaPresionadaEsUnNumero = Number.isInteger(
          parseInt(teclaPresionada)
        );
        const sePresionoUnaTeclaNoAdmitida =
          teclaPresionada != "ArrowDown" &&
          teclaPresionada != "ArrowUp" &&
          teclaPresionada != "ArrowLeft" &&
          teclaPresionada != "ArrowRight" &&
          teclaPresionada != "Backspace" &&
          teclaPresionada != "Delete" &&
          teclaPresionada != "Enter" &&
          !teclaPresionadaEsUnNumero;
        const comienzaPorCero =
          this.nodo.value.length === 1 && teclaPresionada == 1;

        if (sePresionoUnaTeclaNoAdmitida || comienzaPorCero) {
          evento.preventDefault();
        } else if (teclaPresionadaEsUnNumero) {
          this.valor += String(teclaPresionada);
        }
      }.bind(this)
    );

    this.nodo.addEventListener(
      "input",
      function (evento) {
        const cumpleFormatoEsperado = new RegExp(/^[0-9]+/).test(
          this.nodo.value
        );
        if (!cumpleFormatoEsperado) {
          this.nodo.value = this.valor;
        } else {
          this.valor = this.nodo.value;
        }
      }.bind(this)
    );
  }
}

 
function verPdf2(dataid,titulo=''){
	var isCenter = true;
	var features = '',myWidth = 1024, myHeight = 768;
	if(window.screen)if(isCenter)if(isCenter==true){
	    var myLeft = (screen.width*1-myWidth*1)/2;
	    var myTop = (screen.height*1-myHeight*1)/2;
	    features+=(features!='')?',':'';
	    features+=',left='+myLeft+',top='+myTop;
	  }
	if(dataid != ''){
	window.open (dataid , titulo,features+((features!='')?',':'')+'width='+myWidth+',height='+myHeight); 
	}else {alert('Hoja de ruta sin Data agregada');}
}
function verPdf(dataid,titulo=''){
	var isCenter = true;
	var features = '',myWidth = 1024, myHeight = 768;
	if(window.screen)if(isCenter)if(isCenter==true){
	    var myLeft = (screen.width*1-myWidth*1)/2;
	    var myTop = (screen.height*1-myHeight*1)/2;
	    features+=(features!='')?',':'';
	    features+=',left='+myLeft+',top='+myTop;
	  }
	if(dataid != ''){
	window.open ( geturl() +"views/layout/default/pdf/"+dataid , titulo,features+((features!='')?',':'')+'width='+myWidth+',height='+myHeight); 
	}else {alert('Hoja de ruta sin Data agregada');}
}