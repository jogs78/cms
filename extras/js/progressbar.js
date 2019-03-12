// Progressbar - Version 2.0
// Author: Brian Gosselin of http://scriptasylum.com
// PUT THE NAMES OF ALL YOUR IMAGES THAT NEED TO BE "CACHED" IN THE "imagenames" ARRAY.
// DONT FORGET THE COMMA BETWEEN EACH ENTRY, OR THE TICK MARKS AROUND EACH NAME.
// WHEN ALL THE IMAGES ARE DONE LOADING, THE "imagesdone" VARIABLE IS SET TO "TRUE"


// Aca deberás declarar las imágenes que desees que sean precargadas 

var imagenames=new Array( 'img/btn.jpg', 'img/btn2-long-hover.jpg', 'img/btn2-long.jpg', 'img/btn2-longmc-hover.jpg', 'img/btn2-longmc.jpg', 'img/btn2.jpg', 'img/btn2hover.jpg', 'img/btnhover.jpg', 'img/btnhover1.jpg');

var yposition=206;           // Posición en que se carga la barra desde la posición
                             // de arriba de la ventana, en Pixels.
var loadedcolor='#FF0000' ;  // Color del progreso de la barra.
var unloadedcolor='#FFFFFF'; // Color del Fondo, del área que no ha sido cargada.
var barheight=15;            // Alto de la Barra de progreso en Pixels (Mínimo 25)
var barwidth=265;            // Ancho de la Barra en Pixels
var bordercolor='Black';     // Color del Borde


// Modificación realizada por Gabriel M. Rodríguez (webmaster@gamarod.com.ar)
// que muestra en la barra de estado, la cantidad de imágenes cargas y 
// el redireccionamiento cuanda la carga de las imágenes finaliza.


// A partir de aca no hace falta tocar nada.
// -----------------------------------------

//DO NOT EDIT BEYOND THIS POINT 
var NS4 = (navigator.appName.indexOf("Netscape")>=0 && parseFloat(navigator.appVersion) >= 4 && parseFloat(navigator.appVersion) < 5)? true : false;
var IE4 = (document.all)? true : false;
var NS6 = (parseFloat(navigator.appVersion) >= 5 && navigator.appName.indexOf("Netscape")>=0 )? true: false;
var pagina = "inicio.html";
var imagesdone=false;
var blocksize=barwidth/(imagenames.length);
barheight=Math.max(barheight,25);
var loaded=0, perouter, perdone, images=new Array();
var txt=(NS4)?'<layer name="perouter" bgcolor="'+bordercolor+'" visibility="hide">' : '<div id="perouter" style="position:absolute; visibility:hidden; background-color:'+bordercolor+'">';
txt+='<table cellpadding="0" cellspacing="1" border="0"><tr><td width="'+barwidth+'" height="'+barheight+'" valign="center">';
if(NS4)txt+='<ilayer width="100%" height="100%"><layer width="100%" height="100%" bgcolor="'+unloadedcolor+'" top="0" left="0">';
txt+='<table cellpadding="0" cellspacing="0" border="0"><tr><td valign="center" width="'+barwidth+'" height="'+barheight+'" bgcolor="'+unloadedcolor+'"><center><font color="'+loadedcolor+'" size="1" face="Verdana">Cargando imágenes...</font></center></td></tr></table>';
if(NS4) txt+='</layer>';
txt+=(NS4)? '<layer name="perdone" width="100%" height="'+barheight+'" bgcolor="'+loadedcolor+'" top="0" left="0">' : '<div id="perdone" style="position:absolute; top:1px; left:1px; width:'+barwidth+'px; height:'+barheight+'px; background-color:'+loadedcolor+'; z-index:100">';
txt+='<table cellpadding="0" cellspacing="0" border="0"><tr><td valign="center" width="'+barwidth+'" height="'+barheight+'" bgcolor="'+loadedcolor+'"><center><font color="'+unloadedcolor+'" size="1" face="Verdana">Cargando imágenes...</font></center></td></tr></table>';
txt+=(NS4)? '</layer></ilayer>' : '</div>';
txt+='</td></tr></table>';
txt+=(NS4)?'</layer>' : '</div>';
document.write(txt);
// ---- codigo agregado para redireccionar ---------
function redireccionar() 
{
	location.href = pagina;
} 
// -------------------------------------------------
function loadimages(){
	if(NS4){
		perouter=document.perouter;
		perdone=document.perouter.document.layers[0].document.perdone;
	}
	if(NS6){
		perouter=document.getElementById('perouter');
		perdone=document.getElementById('perdone');
	}
	if(IE4){
		perouter=document.all.perouter;
		perdone=document.all.perdone;
	}
	cliplayer(perdone,0,0,barheight,0);
	window.onresize=setouterpos;
	setouterpos();
//	var n = 0;
	for(n = 0; n < imagenames.length; n++){
		images[n]=new Image();
		images[n].src=imagenames[n];
		setTimeout('checkload('+n+')' ,n*100);
	}
//	if (n == imagenames.length)
		redireccionar();
		
}
function setouterpos(){
var ww=(IE4)? document.body.clientWidth : window.innerWidth;
var x=(ww-barwidth)/2;
if(NS4){
perouter.moveTo(x,yposition);
perouter.visibility="show";
}
if(IE4||NS6){
perouter.style.left=x+'px';
perouter.style.top=yposition+'px';
perouter.style.visibility="visible";
}}

function dispbars(){
	loaded++;
	window.status="Precarga de las imágenes ... "+loaded+" / "+imagenames.length;
	cliplayer(perdone, 0, blocksize*loaded, barheight, 0);
	if(loaded>=imagenames.length)setTimeout('hideperouter()', 800);
}
function checkload(index){
	(images[index].complete)? dispbars() : setTimeout('checkload('+index+')', 100);
}

function hideperouter(){
	(NS4)? perouter.visibility="hide" : perouter.style.visibility="hidden";
	imagesdone=true;
	window.status='';
}
function cliplayer(layer, ct, cr, cb, cl){
if(NS4){
layer.clip.left=cl;
layer.clip.top=ct;
layer.clip.right=cr;
layer.clip.bottom=cb;
}
if(IE4||NS6)layer.style.clip='rect('+ct+' '+cr+' '+cb+' '+cl+')';
}
window.onload=loadimages;