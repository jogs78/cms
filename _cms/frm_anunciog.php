<?php
/**
 * @name Formulario de Noticias
 * @author Ing. Jorge Octavio Gúzman Sánchez
 * @package _cms
 * @version 2.0.1
 * 
 * @abstract Esta página es utilizada para dar de alta,
 *modificar o eliminar un anuncio grafico de la
 * base de datos.
 * 
 * @param int $_GET['idg'] Ide del anuncio grafico. (este puede referenciar a cualquier tipo.
 * @param int $_GET['act'] Acción a realizar  2 -> Modificar, 3 -> Eliminar 
 * @param null cuando esta página no recibe ningun parametro entra en el modo
 * de Agregar Nueva noticia.
 */
session_start();
/**
 * Aquí se verifica que se haya iniciado una session de administración
 */
if (!isset($_SESSION["INCMS"])){
	exit;
}
/**
 * Se crea el objeto $sys para grabar un log de actividad
 */
include('sistema.inc.php');
$sys = new sistema();
//$sys->lget();
if(isset($_GET["act"]) ) $accion=$_GET["act"]; else $accion=1; //1.- alta, 2.-modificacion
$fecha = date("Y-m-d");
$titulo=""; $orden=""; $img=""; $central=""; $izq=""; $der="";
if(isset($_GET["idg"])) $id=$_GET["idg"]; else $id="1";
if($accion!=1) if( !$sys->puede($_SESSION['id'] , ANUNCIOG , VER) ) exit; 
$sql="SELECT * FROM anunciog WHERE idg=$id";
//$sys->conn->debug=true;
$row = $sys->conn->GetRow($sql);
$sys->conn->debug=false;
if($accion !=1 ){
	$sql="SELECT * FROM anunciog WHERE idg=$id";
	$row = $sys->conn->GetRow($sql);
	if (!$row){ 
		echo "CONTENIDO NO DISPONIBLE";
		exit;
	}else{
		$titulo = $row["titulo"];
		$img=$row["img"]; 
		$tipo=$row["tipo"];
		$fecha=$row["fecha"];
		$ida=$row["id"];
		$central=$row["central"];
		$izq=$row["izq"];
		$der=$row["der"];
		$url=$row["url"];
		$orden=$row["orden"];
	}
}

if($accion ==2 ){
	$sql="SELECT * FROM anunciog WHERE idg=$id";
	$row = $sys->conn->GetRow($sql);
	if (!$row){ 
		echo "CONTENIDO NO DISPONIBLE";
		exit;
	}else{
		$titulo = $row["titulo"];
		$img=$row["img"]; 
		$tipo=$row["tipo"];
		$fecha=$row["fecha"];
		$ida=$row["id"];
		$central=$row["central"];
		$izq=$row["izq"];
		$der=$row["der"];
		$url=$row["url"];	
		$orden=$row["orden"];
		switch ($tipo) {
			case '2':  //CONTENIDO
			$tbltipo = "entrada";
			$cadand = " and id not in (select IF(ISNULL(id),0,id)  from anunciog) ";
			break;
			case '999':  //SISTEMA
			$tbltipo = "entrada";
			$cadand = " and id not in (select IF(ISNULL(id),0,id)  from anunciog) ";
			break;
			case '1000':  //PAGINA
			$tbltipo = "entrada";
			$cadand = " and id not in (select IF(ISNULL(id),0,id)  from anunciog) ";
			break;
			case '3':  //ANUNCIO
			$tbltipo = "anuncio";
			$cadand = " where id not in (select IF(ISNULL(id),0,id)  from anunciog) ";
			break;
			case '4':  //NOTICIA
			$tbltipo = "anuncio";
			$cadand = " where id not in (select IF(ISNULL(id),0,id)  from anunciog) ";
			break;
		}
	}
}
/**
 * Desabilitamos todos los campos si la opción elegida es Eliminar
 */
if ($accion==3) $dis = " disabled "; else $dis ="";

switch ($accion){
	case 1: $cap="AGREGAR";  break;
	case 2: $cap="MODIFICAR ";  break;
	case 3: $cap= "ELIMINAR ";  break;
}
$sys->currentid = $id;
if ($accion!=1) $sys->log( $_SESSION['id'] , ANUNCIOG , VER );

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<TITLE>FORMULARIO ANUNCIO GRAFICO</TITLE>
<SCRIPT language="JavaScript" src="../extras/ajax.js"></SCRIPT>
<SCRIPT language="javascript"><!--
  function carga(opc, dst ){
//	alert('opc'+opc + '  dst' + dst);
	var cad ;
	var cadand = "";
	var cadand2 = "";
	<?php
		if ($accion ==1){
			echo 'cadand = " and id not in (select IF(ISNULL(id),0,id)  from anunciog) ";';
			echo 'cadand2 = " where id not in (select IF(ISNULL(id),0,id) from anunciog) ";';
			}
	?>
	cad="";
	chn(opc);
	switch (opc.value ) {
		case '2':  //CONTENIDO
		cad = "select.php?cadsql=SELECT id, titulo from entrada  where tipo = 2 " + cadand + " ORDER BY id DESC;";
		break;
		case '999':  //SISTEMA
		cad = "select.php?cadsql=SELECT id, titulo from entrada  where tipo = 999 " + cadand + " ORDER BY id DESC;";
		break;
		case '1000':  //PAGINA
		cad = "select.php?cadsql=SELECT id, titulo from entrada  where tipo = 1000 " + cadand + "  ORDER BY id DESC;";
		break;
		case '3':  //ANUNCIO
		cad = "select.php?cadsql=SELECT id, titulo from anuncio " + cadand2 + " ORDER BY id DESC;";
		break;
		case '4':  //NOTICIA
		cad = "select.php?cadsql=SELECT id, titulo from noticia " + cadand2 + " ORDER BY id DESC;";
		break;
		case '5':  //CONTENEDOR
		cad = "select.php?cadsql=SELECT id, titulo from entrada  where tipo = 5 " + cadand + " ORDER BY id DESC;";
		break;
		case '2000':  //URL
		break;		
	}
//	alert(cad);
	if (cad!="") cargarContenido2(dst , cad   );
}
 --> </SCRIPT>
<SCRIPT language="JavaScript" src="../extras/validate.js"></SCRIPT>
<link href="cms.css" rel="stylesheet" type="text/css">
<style  type="text/css">@import url(../extras/jscalendar-1.0/calendar-ittg.css);</style>
<SCRIPT type="text/javascript" src="../extras/jscalendar-1.0/calendar.js"></SCRIPT>
<SCRIPT type="text/javascript" src="../extras/jscalendar-1.0/lang/calendar-es.js"></SCRIPT>
<SCRIPT type="text/javascript" src="../extras/jscalendar-1.0/calendar-setup.js"></SCRIPT>
<SCRIPT type="text/JavaScript" language="JavaScript">
<!--
function titular(cmb1,txt){
	txt.value = cmb1.item(cmb1.selectedIndex).text;
}
-->
</SCRIPT> 
</HEAD>
<BODY>
<?php 
//echo "<br>|  | idg:$id | img:$igm           | titulo:$titulo   | tipo:$tipo | id:$ida | fecha:$fecha |accion:$accion|||";
echo "<CENTER> <H1>$cap ANUNCIO GRAFICO </H1> </CENTER>"; ?>
<form name="frmanunciog" method="post" action="prc_anunciog.php" enctype="multipart/form-data">
<input type="hidden" name="act" value="<?php echo $accion ?>">
<input type="hidden" name="idg" value="<?php echo $id?>">
<p>
<script language="javascript"><!--
	function chn(cmb){
		d1 = document.getElementById("entradas");
		d2 = document.getElementById("libres");
		if (cmb.value != 2000 ) {
			d1.style.top = d2.style.top;
			d1.style.left  = d2.style.left;
			d1.style.visibility = "visible";
			d2.style.visibility = "hidden";
		}else{
			d2.style.top = d1.style.top;
			d2.style.left  = d1.style.left;
			d1.style.visibility = "hidden";
			d2.style.visibility = "visible";
		}
	}
 --> </script>
 
TIPO <select <?php echo $dis ?> name="tipo" onchange="carga(tipo,ida);"> 
    <?php 
	echo $sys->conn->catalogo("SELECT * FROM tipo2"); 
?> 
  </select> 
	<script language="JavaScript" type="text/JavaScript"> 
	document.frmanunciog.tipo.value = '<?php echo $tipo ?>'; 
	//carga(document.frmanunciog.tipo,document.frmanunciog.ida); 
	</script>
  <BR>  	 
  <BR>  	 
<!----->
  <span id="entradas" style="position:absolute; visibility:visible">  
	TITULO: <input type="hidden2" name="titulo" size="80"   <?php echo $dis;  if($titulo!="") echo  'value="'. $titulo .'"'?>>	<br>	

  <BR>  	 
  <BR>  	 
	TEMA: <select <?php echo $dis ?> NAME="ida" onchange="titular(ida,titulo);" >
      <?php    echo $sys->conn->catalogo("SELECT id, titulo from  $tbltipo ORDER BY id DESC;"); ?> 
   </select> 
	<script language="JavaScript" type="text/JavaScript"> 
	document.frmanunciog.tipo.value = '<?php echo $tipo ?>'; 
	//carga(document.frmanunciog.tipo,document.frmanunciog.ida); 
	document.frmanunciog.ida.value = '<?php echo $ida ?>'; 
	</script><br>
</span>
<span id="libres" style="position:absolute; visibility:hidden">
	TITULO: <input type="hidden2" name="titulo_url" size="100"   <?php echo $dis;  if($titulo!="") echo  'value="'. $titulo .'"'?>><br>	
	URL   : <input type="hidden2" name="url" size="100"   <?php echo $dis;  if($titulo!="") echo  'value="'. $url .'"'?>>		
</span>
<?php
	echo "<script language=\"javascript\">\n";
	echo "	d1 = document.getElementById(\"entradas\");\n";
	echo "	d2 = document.getElementById(\"libres\");\n";
	if ($tipo == 2000 ) {		 
		echo "	d2.style.top = d1.style.top;\n";
		echo "	d2.style.left  = d1.style.left;\n";
		echo "	d1.style.visibility = \"hidden\";\n";
		echo "	d2.style.visibility = \"visible\";\n";
	}else if ($tipo != 2000 ){
		echo "	d1.style.top = d2.style.top;\n";
		echo "	d1.style.left  = d2.style.left;\n";
		echo "	d2.style.visibility = \"hidden\";\n";
		echo "	d1.style.visibility = \"visible\";\n";
	}
	echo " \n-->\n"; 
	echo "  </script>\n";
?>
<!----->
  <br>
    <script language="JavaScript" type="text/JavaScript"> 
//	alert('1');
</script> 
<br>
<br>
<br>
<br>
  <p> ORDEN <input type="text" name="orden" size="3"   <?php echo $dis;  echo "value=\"$orden\"" ?> >		

  <BR>
  <BR>
  <BR>
  <p>IMAGEN <?php echo "(".$img.")" ?> 
    <input <?php echo $dis ?> type="file" name="img">
    <BR>
SI LA IMAGEN ES PARA EL CENTRO SE RECOMIENDA DE 480 PIXELES DE ANCHO<BR>
SI LA IMAGEN ES PARA EL LADO IZQUIERDO SE RECOMIENDA DE 135 PIXLES DE ACHO<BR>
</p>
  <p>&nbsp;</p>
  <p>COLOCAR : </p>
  <p>
    <label>
    <input type="radio" name="lugar" value="centro"  <?php echo ($central)? " checked " : ""  ?>>
CENTRO</label>
    <br>
    <label>
    <input type="radio" name="lugar" value="izq"  <?php echo ($izq)? " checked " : ""  ?>>
IZQUIERDA</label>
    <br>
    <label>
    <input type="radio" name="lugar" value="der" <?php echo ($der)? " checked " : ""  ?> >
DERECHA</label>
    <br>
  </p>
  <p><BR>
    
    FECHA ENTRA EN VIGENCIA<font color="#FF0000">*</font> 
    <input type="text"   id="data3" name="fecha" value="<?php echo $fecha ?>" />
    <script type="text/javascript">
//		
  Calendar.setup(
    {
      inputField  : "data3",         // ID of the input field
      ifFormat    : "%Y-%m-%d",    // the date format
 	  weekNumbers : false,
	  singleClick : false,
	  range       : [2000,2015],
    eventName     : "focus",
//      button      : "trigger",       // ID of the button
	  step        :  1
    }
  );
    </script>
    
    <br>
    <input type="submit" value="<?php echo $cap ?>">
      </p>
</form>
</body>
</html>
