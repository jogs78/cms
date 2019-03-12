<!--
function seguir(cmb){
	if (cmb.value == 7 ) {
		return false;
	}else{
		return true ;
	}
}

/* Si el cmb esta en 999, el txt se activa*/
function chn(cmb,txt){
	if (cmb.value >= 999 ) {
		txt.disabled = false ;
		return true;
	}else{
		txt.disabled = true ;
		return false;
	}
}

/* Si el cmb esta en 999, el txt se activa*/
function chnp(cmb,txt,cmb2,txt2){
	if (cmb.value == 999 ) {
		txt.disabled = false ;
		cmb2.disabled = true ;
		cmb2.value=999;
		txt2.disabled = false ;
		return true;
	}else{
		txt.disabled = true ;
		cmb2.disabled = false ;
		txt2.disabled = true ;

		return false;
	}
}


function chnn(cmb,txt,cmb2,txt2,cmb3,txt3){
	if (cmb.value == 999 ) {
		txt.disabled = false ;
		cmb2.disabled = true ;
		cmb2.value=999;
		txt2.disabled = false ;
		cmb3.disabled = true ;
		cmb3.value=999;
		txt3.disabled = false ;
		return true;
	} else {
		txt.disabled = true ;
		cmb2.disabled = false ;
		txt2.disabled = true ;
		cmb3.disabled = false ;
		txt3.disabled = true;
		return false;
	}
}



//chnp(estado_f,estado2_f,municipio_f,municipio2_f)
/*		while (cmb2.length > 0) {
			cmb2.remove(0);
		}
		var opt = document.createElement("option");
		cmb2.value = -1;
		cmb2.appendChild(document.createTextNode("DIGA EL"));
		cmb2.appendChild(opt);
*/


function chne(cmb,txt,cmb2,txt2,cmb3,txt3,cmb4){
	cmb4.disabled = false ;
	if (cmb.value == 999 ) {
		txt.disabled = false ;
		cmb2.disabled = true ;
		cmb2.value=999;
		txt2.disabled = false ;
		cmb3.disabled = true ;
		cmb3.value=999;
		txt3.disabled = false ;
		return true;
	}else if (cmb.value == 7  ) {
		txt.disabled = true ;
		cmb2.disabled = false ;
		txt2.disabled = true ;
		cmb3.disabled = false ;
		txt3.disabled = true ;
		return false;
	}else {
		txt.disabled = true ;
		cmb2.disabled = false ;
		txt2.disabled = true ;
		cmb3.disabled = true ;
		txt3.disabled = false;
		return false;
	}

}

//-->
