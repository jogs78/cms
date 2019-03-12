<?php


function visitantes_activos() {
	// Tomamos la ip del visitante
	$ip_visita = $_SERVER['REMOTE_ADDR'];
	//Momento actual
    $ahora = time();

    //conectamos a la base de datos
	$conectado = mysql_connect('localhost','content2_root','content2_password');
	mysql_select_db('content2',$conectado);

	//borramos los registros de las ip inactivas
    $limite = $ahora-500;
    $sql = "delete from visitas where fecha < ".$limite;
	mysql_query($sql);

    //miramos si el ip del visitante existe en nuestra tabla
    $sql = "select ip, fecha from visitas where ip = '$ip_visita'";
    $resultado = mysql_query($sql);

    //si existe actualizamos el campo fecha
    //si no existe insertamos el registro correspondiente a esta visita
	if (mysql_num_rows($resultado) != 0){
		$sql = "update visitas set fecha = ".$ahora." where ip = '$ip_visita'";
	} else {
		$sql = "insert into visitas (ip, fecha) values ('$ip_visita', $ahora)";
	}
    mysql_query($sql);

    //contamos el numero de visitas activas
    $sql = "select ip from visitas";
	$resultado = mysql_query($sql);
    $visitas = mysql_num_rows($resultado);

    //liberamos memoria
    mysql_free_result($resultado);

    //devolvemos el resultado
    return $visitas;
 }

// Vemos el numero de visitantes activos
$visact = visitantes_activos();

function printact(){
	echo "<img src=\"img/users.gif\" />"; 
	if ($visact == 1){
		echo "Hay $visact usuario";
	}else{
		echo "Hay $visact usuarios";
	}
}
?>