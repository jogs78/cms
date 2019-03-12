var _jslib_isIE = document.all?true:false;
var _jslib_isNS = document.layers?true:false;
var _jslib_isNS6 = document.getElementById&&!document.all?true:false;
i=new Image;
i.src='loading.gif';


function GetObject(name) {
	if(_jslib_isIE) {
		return document.all[name];
	} else if(_jslib_isNS) {
		return document.layers[name];
	} else if (_jslib_isNS6) {
		return document.getElementById(name);
	}
	return null;
}


function MyAjax() {
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function saludar(){
	alert('hola');
}

function llenar(dst, uurl) {
	var result_data = "";			
	var ajax = MyAjax();
//	alert ('dst=' + dst);
//	add(dst, -1, "Seleccione 0");
//	alert ('dst=' + dst);
	ajax.open("GET", uurl, true);
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {				
			if (ajax.status == 200) {
//				alert(resultado);
//				alert(dst);
//				clear(dst);
//				add(dst, -1, "Seleccione 1");
				var resultado = ajax.responseText;
				dst.disabled = false;	
				var resultado_split = resultado.split("|");
//			add(dst, -1, "Seleccione un ...");
				for (i=0; i < resultado_split.length-1; i++) {
					result_data = resultado_split[i].split(",");
//					alert (resultado_split[i] + ' => ' + result_data[0] + ' -- ' + result_data[1] );
					add(dst, result_data[0], result_data[1]);
				}					
			} else {
				alert("Error Número: " + ajax.status + "\nDescripción: " + ajax.statusText);	
			}
		} else {
//			dst.disabled = true;
		}
	}
	ajax.send(null);
}


function cargarContenido(src, dst, div, url,url_loading) {
	var ajax = MyAjax();
    var uurl = url + src.value;
//	alert(" URL:" + url + " UURL:" + uurl);
	ajax.open("GET", uurl, true);
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {				
			if (ajax.status == 200) {
				var resultado = ajax.responseText;
				var result_data = "";			
				clear(dst);
				div.innerHTML = "";
				add(dst, -1, "Seleccione un ...");
				dst.disabled = false;	
				var resultado_split = resultado.split("|");
				for (i=0; i < resultado_split.length-1; i++) {
					result_data = resultado_split[i].split(",");
					add(dst, result_data[0], result_data[1]);
				}					
			} else {
				alert("Error Número: " + ajax.status + "\nDescripción: " + ajax.statusText);	
			}
		} else {
			dst.disabled = true;
			div.innerHTML = "<img src=' + url_loading + '>";
		}
	}
	ajax.send(null);
}

/*
# Cuando llamamos al método open del objeto XMLHttpRequest como primer parámetro indicamos el string 'POST'
conexion1.open('POST','pagina1.php', true);
# Llamamos al método setRequestHeader indicando que los datos a enviarse están codificados como un formulario.
conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
# Llamamos al método send del objeto XMLHttpRequest pasando los datos:
conexion1.send("nombre=juan&clave=z80");
*/

function add(obj, value, content) {
//	alert ('agregar: ' + value + ': ' + content);
	var opt = document.createElement("option");
	opt.value = value;
	opt.appendChild(document.createTextNode(content));
	var objt = GetObject(obj);
//	alert (objt);
	objt.appendChild(opt);
}


function clear(obj) {
	while (obj.length > 0) {
		alert(obj.length);
		obj.remove(0);
	}
		alert(obj.length);

}