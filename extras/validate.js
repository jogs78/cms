<!--
function validar_formulario(frm) {
	errores = "";
	PWDS = "";
	for (i=0; i<(frm.elements.length); i++){
		if(!frm.elements[i].alt)continue;
		ALT=frm.elements[i].alt;
		NAME=frm.elements[i].name;
		VALUE=frm.elements[i].value;
		DEP=frm.elements[i].disabled;
		//errores+=NAME+'\n';
		ESP=ALT.split(",");
		NAME=ESP[3];
		//alert (NAME + '-'.ALT+'-'+VALUE);
		if (ESP[0]=='R'){
			if (VALUE == "") errores+=NAME+' es requerido\n';
		}  
		//alert(DEP);
		//!DEP es que esta habilitado
		if (!DEP && ESP[0]=='D' && VALUE == "")  errores+=NAME+' es requerido si es habilitado\n';
		/* si es opcional pero tiene algo, checarlo*/
		/*
		0 R | D | O
		1	texto | numero | rango:#:# | positivo | correo | passwd:#:#
		*/
		validar=ESP[1];
		if (validar.indexOf("rango")==0) validar="rango";
		if (validar.indexOf("passwd")==0) validar="passwd";
		switch(validar){
			case 'texto' :
				if (!isNaN(VALUE) && VALUE != "") errores+=NAME+' debe ser texto\n';
			break;
			case 'numero' :
				if (isNaN(VALUE) && VALUE != "") errores+=NAME+' debe ser un número\n';
			break;
			case 'rango' :
				RANGO = ESP[1].split(":");		  
				if (isNaN(VALUE) && VALUE != "") errores+=NAME+' debe ser un número\n';
				else if ((VALUE<RANGO[1] || VALUE>RANGO[2]) && VALUE != "") errores+=NAME+' vale '+VALUE+' y debe ser un número en el rango de '+RANGO[1]+' hasta '+RANGO[2]+'\n'
			break;
			case 'positivo' :
				if (isNaN(VALUE) && VALUE != "") errores+=NAME+' debe ser un número\n';
				else if ((VALUE<0) && VALUE != "") errores+=NAME+' vale '+VALUE+' y debe ser un número positivo\n'
			break;
			case 'correo':
				a=VALUE.indexOf('@');
				p=VALUE.indexOf('.');			
				e=VALUE.indexOf(' ');			
				if ((a<1 || p<1 || e>0) && VALUE != "") errores+=NAME+' debe contener una dirección de correo valida.\n';
			break;
			case 'passwd':
				//PWS[0] es el numero de grupo
				//PWS[1] es el numero consecutivo dentro del grupo
				PWS = ESP[1].split(":");	
				gpo=PWS[1];
				item=PWS[2];
				if(item==0){
					PWDS = VALUE;
				}
				if(item==1){
					if (PWDS != VALUE){
						errores+=NAME+' no corresponde la confirmacion de la contraseña\n';	
					}
				}
			break;
		}
		if (ESP[2]=="mayusculas") frm.elements[i].value = VALUE.toUpperCase();
		if (ESP[2]=="minusculas") frm.elements[i].value = VALUE.toLowerCase();
	}
	if (errores != "") {
		errores = 'CHECAR:\n' + errores;
		alert(errores);
		return false;
	}else{
		return true;
	}
}
//-->