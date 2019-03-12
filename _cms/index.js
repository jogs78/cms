/**
 * Funcion para hacer que cambie de color
 * un input 
 */
 
 function hover( id ){
 	var input = document.getElementById(id);
 	input.style.border="#62FA3C solid 1px";
 	input.style.backgroundColor="#F0FFEC";
 }
 function hover_reset( id ){
 	var input = document.getElementById(id);
 	input.style.border="#aabbcc solid 1px";
 	input.style.backgroundColor="#FFFFFF";
 }
 
 function enfocar(){
 	var input = document.getElementById("usuario");
 	input.focus();
 }
 
 window.onload = enfocar;