function validator(frm){
	var i = 3;
	var l;
	var a,b,c,v,n;
	var alte, valu, tipo, msg;
	i ++;
	l=frm.elements.length;
	for (i=0; i< l; i++){
		if (frm.elements(i).alt != ""){
			tipo = new String(frm.elements(i).type);
			if (frm.elements(i).type!="text"){
				continue;
			}
			alte = new String(frm.elements(i).alt);
			if (alte.length == 0) continue;
			a = alte.charAt (0);
			b = alte.charAt (1);
			msg = alte.substr(2,alte.length)
			valu = new String(frm.elements(i).value);
			c = valu.length;
			n=isNaN(frm.elements(i).value);
			if (a == '+'){
			//obligatorio
				if (c==0){
					alert (msg + ' esta vacio');
					return false;
				}
				
				if (b=='#' && n == true){
					alert (msg + ' debe ser un numero');
					return false;
				}
				if (b=='@'){
					if (!IsEMail(valu)) return false;
				}

			}else{
			//opcional
				if (c==0){
					continue;
				}
				if (b=='#' && n == true){
					alert (msg + ' debe ser un numero');
					return false;

				}
				if (b=='@'){
					if (!IsEMail(valu)) return false;
				}
			}
			
		}	
	}
	return true;
}
function IsEMail(email){

	var i,a;
//	email  = new String(em);
	if (email.charAt(0)=='@' || (email.charAt(0)>='0' && email.charAt(0)<='9'  )){ 
		alert ("No puede comenzar por numero o caracteres .... ");
		return false;
	}
	a= 0;
	for (i=0; i < email.length; i++){
		if (i>0){
			if (email.charAt(i)=='@') a++;
		}
	
		if (email.charAt(i)==' '){ 
			alert ("No puede contener espacios en blanco");
			return false;
		}
	}
	if (a!=1){
		alert ("Debe contener una @");
		return false;
	}
	
	return true;
}

function onchk(chk,txt){
	if (chk.checked ) {
		txt.disabled = false ;
	}else{
		txt.disabled = true ;
	}
}

function activar(txt){
		txt.disabled = ! txt.disabled ;

}


function asignar (ctl, vl){
	ctl.value = vl
	ctl.disabled = true ;
}
