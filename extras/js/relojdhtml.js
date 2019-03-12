/* relojdhtml.js compiled from X 4.0 with XC 0.27b. Distributed by GNU LGPL. For copyrights, license, documentation and more visit Cross-Browser.com */
function xGetElementById(e)
	{
		if(typeof(e)!='string')
			return e;
		if(document.getElementById) 
			e=document.getElementById(e);
		else if(document.all)
			e=document.all[e];
		else 
			e=null;
		return e;
	}

function xInnerHtml(e,h)
{
	if(!(e=xGetElementById(e)) || !xStr(e.innerHTML))
		return null;
	var s = e.innerHTML;if (xStr(h)) 
	{
		e.innerHTML = h;
	}return s;
}
function xStr(s)
{
	for(var i=0; i<arguments.length; ++i)
	{
		if(typeof(arguments[i])!='string')
			return false;
	}return true;
}

function mueveReloj(){
    momentoActual = new Date();
    
	hora = momentoActual.getHours();
	if (hora<10)
		hora = "0" + hora;

	minuto = momentoActual.getMinutes();
	if (minuto<10)
		minuto = "0" + minuto;

	segundo = momentoActual.getSeconds();
	if (segundo<10)
		segundo = "0" + segundo;

    horaImprimible = hora + " : " + minuto + " : " + segundo;

    cambiaTexto(horaImprimible);
	
	setTimeout("mueveReloj()",1000);
} 

function cambiaTexto(nuevaHora){
	xInnerHtml('capa_reloj',nuevaHora);
}

//window.onload = mueveReloj();