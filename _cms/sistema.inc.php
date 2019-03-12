<?php
/**
 * @name Sistema.inc
 * @author Ing. Jorge Octavio Gúzman Sánchez
 * @version 1.4.08
echo "ssss";
 */
require ('../extras/adodb496a/adodb.inc.php'); 
define("ENTRADA", 1);
define("CONTENIDO", 2);
define("NOTICIA", 3);
define("AVISO", 4);
define("ANUNCIOG", 5);
define("COMENTARIO", 6);
define("BANNER", 7);
define("POSTOR", 12);
define("PROPUESTA", 8);
define("USUARIO", 9);
define("BITACORA", 10);
define("SISTEMA", 11);
define("AGREGADO", 13);



define("AGREGAR", 1);
define("MODIFICAR", 2);
define("ELIMINAR", 3);
define("CONTESTAR", 4);
define("ORDENAR", 5);
define("LISTAR", 6);
define("PROPONER", 8);
define("REVISAR", 9);
define("VER", 10);
define("ENTRAR", 11);
define("SALIR", 12);
define("PERMITIR", 13);
define("CAMBIAR", 14);
define("RECORDAR", 14);

define("LOGOUT", 20);


class sistema{
	/**
	 * Enter description here...
	 *
	 * @var int
	 */
	protected $objeto;
	/**
	 * Acción a realizar
	 *
	 * @var int
	 */
	protected $accion;
	/**
	 * Objeto de ADOdb
	 *
	 * @var object
	 */
	public $conn;
	/**
	 * Usuario
	 *
	 * @var String
	 */
	protected $user;
	/**
	 * Contraseña
	 *
	 * @var String
	 */
	protected $pwd;
	/**
	 * Selecciona la base de datos
	 *
	 * @var String
	 */
	protected $db;
	/**
	 * Define el Host
	 *
	 * @var String
	 */
	protected $host;
	/**
	 * Fecha actual
	 *
	 * @var Time
	 * @example 2008-01-01 Se encuentra con el formato Y-m-d
	 */
	protected $fecha;
	/**
	 * Hora Actual
	 *
	 * @var Time
	 * @example 21:24:00 en formato H:i
	 * $hora=date("H:i" ,time());
	 */
	protected $hora;
	/**
	 * Valor mixto
	 *
	 * @var int
	 */
	public $currentid;
	
	function __construct($_bd="content2"){
		global $ADODB_CACHE_DIR;
		$this->user="content2_root";
		$this->pwd="content2_password";
		$this->db="content2";
		$this->host="localhost";
		$this->conn = ADONewConnection('mysqli');
		$this->conn->PConnect($this->host,$this->user,$this->pwd,$this->db);
		$this->currentid=0;
	}

	function __destruct(){
		$this->conn->Close();
	}

	public function debug($edo = true){
		$this->conn->debug=$edo;
	}
	public function quien($_id = -1){
		$this->id=$_id;
	}	
	/**
	 * Guarda un historial de la actividad realizada
	 * por los usuarios dentro del sistema en la tabla LOG
	 *
	 * @param int $quien
	 * @param int$objeto
	 * @param int $accion
	 * @param mixed $q
	 */
	public function log($quien, $objeto, $accion, $q=""){
		//$this->puede($quien, $objeto, $accion);
		$fecha=@date("Y-m-d" ,time());
		$hora=@date("H:i:s" ,time());
		$q=addslashes  ($q);
		$sql = "INSERT INTO log VALUES ('$fecha','$hora','$quien','$objeto','$accion','$q','$this->currentid');";
		$this->conn->Execute($sql);
	}
	
	/**
	 * Pregunta si un usuario esta o no autorizado
	 * para realizar algun cambio en alguna sección
	 * del manejador de contenidos.
	 *
	 * @param int $quien
	 * @param int $objeto
	 * @param int $accion
	 * @return bool
	 */
	public function puede($quien, $objeto, $accion){
		$ret = 0;
		$recordSet = &$this->conn->Execute("SELECT * FROM permisos WHERE usuario = '$quien' AND objeto = '$objeto' AND accion = '$accion';");
		if ($recordSet && !$recordSet->EOF) 
			$ret = 1;
		$recordSet->Close(); 
		if(!$ret){ echo "Si esta seguro de poder realizar esta acci&oacute;n informe: qoa '$quien.$objeto.$accion'"; exit;}
		return $ret;
	}
	/**
	 * Asigna un Objeto
	 *
	 * @param String $obj
	 */
	public function SetObjeto($obj){$this->objeto=$obj;}
	/**
	 * Asigna una acción a realizar
	 *
	 * @param int $acc
	 */
	public function SetAccion($acc){$this->accion=$acc;}
	/**
	 * Retorna una URL para ser utilizada
	 *
	 * @return String
	 */
	public function GetUrl(){
	$extra ="";
		if($this->objeto==ENTRADA     && $this->accion==AGREGAR) return $extra . "frm_entrada.php";
		if($this->objeto==ENTRADA     && $this->accion==ORDENAR) return $extra . "ord_entrada.php";
		if($this->objeto==ENTRADA     && $this->accion==LISTAR ) return $extra . "lst_entrada.php";
		if($this->objeto==CONTENIDO   && $this->accion==AGREGAR) return $extra . "frm_contenido.php";
		if($this->objeto==CONTENIDO   && $this->accion==LISTAR ) return $extra . "lst_contenido.php";
		if($this->objeto==NOTICIA     && $this->accion==AGREGAR) return $extra . "frm_noticia.php";
		if($this->objeto==NOTICIA     && $this->accion==LISTAR ) return $extra . "lst_noticia.php";
		if($this->objeto==AVISO       && $this->accion==AGREGAR) return $extra . "frm_anuncio.php";
		if($this->objeto==AVISO       && $this->accion==LISTAR ) return $extra . "lst_anuncio.php";
		if($this->objeto==ANUNCIOG    && $this->accion==AGREGAR) return $extra . "frm_anunciog.php";
		if($this->objeto==ANUNCIOG    && $this->accion==LISTAR ) return $extra . "lst_anunciog.php";
		if($this->objeto==COMENTARIO  && $this->accion==LISTAR ) return $extra . "lst_comentario.php";	
		if($this->objeto==POSTOR   	  && $this->accion==AGREGAR) return $extra . "frm_postor.php";
		if($this->objeto==POSTOR   	  && $this->accion==LISTAR) return $extra . "lst_postor.php";
		if($this->objeto==PROPUESTA   && $this->accion==AGREGAR) return $extra . "frm_propuesta.php";
		if($this->objeto==PROPUESTA   && $this->accion==PROPONER) return $extra . "pro_propuesta.php";
		if($this->objeto==PROPUESTA   && $this->accion==REVISAR ) return $extra . "rev_propuesta.php";
		if($this->objeto==USUARIO     && $this->accion==AGREGAR) return $extra . "frm_usuario.php";
		if($this->objeto==USUARIO     && $this->accion==LISTAR) return $extra . "lst_usuario.php";
		if($this->objeto==USUARIO     && $this->accion==CAMBIAR) return $extra . "frm_password.php";
		if($this->objeto==AGREGADO     && $this->accion==AGREGAR) return $extra . "frm_agregado.php";
		if($this->objeto==AGREGADO     && $this->accion==LISTAR ) return $extra . "lst_agregado.php";
		if($this->objeto==BITACORA   && $this->accion==REVISAR ) return $extra . "rev_bitacora.php";
		if($this->objeto==LOGOUT) return $extra . "salir.php";	
		return $extra . "contenido.php";
	}
	/**
	 * Genera una lista de todos los datos
	 * que se han pasado por $_GET
	 */
	public function lget(){
		reset($_GET);
		echo "<hr>";
		while (list ($clave, $val) = each($_GET)) {
			echo "$clave = " . $_GET["$clave"] . " ";
		}
		echo "</hr>";
	}
	/**
	 * Genera una lista de todos los datos
	 * que se han pasado por $_POST
	 */
	public function lpost(){
		reset($_POST);
		echo "<hr>";
		while (list ($clave, $val) = each($_POST)) {
			echo "$clave = " . $_POST["$clave"] . " ";
		}
		echo "</hr>";
	}
	public function navegacion(){
		$c=0;
		$objeto = "";
		$objetoa = "";
		//$this->conn->debug=true;
		$sql = "SELECT DISTINCT p.objeto, o.descripcion FROM permisos p JOIN objeto o ON p.objeto = o.id WHERE p.usuario = $this->id ORDER BY o.sec;";
		$rso=$this->conn->Execute($sql);
		echo '<div class="navigation">'."\n";
		echo ' <p>&nbsp;</p>'."\n";		
		$objs=0;
		$s = "";
		if ($rso){
			while(!$rso->EOF){
				$objs++;
				$obj = $rso->fields["objeto"];
				$sql = "SELECT p.accion a,  a.descripcion ad from permisos p JOIN accion a ON p.accion=a.id";
				$sql .= " WHERE usuario=$this->id AND p.objeto=$obj AND menu = 1 ORDER BY p.accion;";
				$rsa=$this->conn->Execute($sql);
				echo ' <div id="CollapsiblePanel' . $rso->fields["objeto"] . '" class="CollapsiblePanel">'."\n";
				echo '  <div><a class="item1">&gt;&gt; ' . $rso->fields["descripcion"] . '</a></div>'."\n";
				echo '  <div class="CollapsiblePanelContent">'."\n";
				$s .= 'var CollapsiblePanel' . $obj . ' = new Spry.Widget.CollapsiblePanel("CollapsiblePanel' . $obj . '", {contentIsOpen:false, duration:100});'."\n";
				while(!$rsa->EOF){
					echo '   <p class="item2"><a href="sistema.php?obj=' . $obj . '&act=' . $rsa->fields["a"] . '">' . $rsa->fields["ad"] . '</a></p>'."\n";
					$rsa->MoveNext();
				}
				echo '  </div>'."\n";
				echo ' </div>'."\n";	
				$rso->MoveNext();
			}
			if($objs >0 && $rsa) $rsa->Close(); # opcional
		}
		//$rs=$this->conn->Execute($sql);
		//$rso->Close(); # opcional
		echo ' <p class="item1l"><a href="sistema.php?obj=20">SALIR</a></p>'."\n";
		echo ' <p>&nbsp;</p>'."\n";
	
		echo '<script type="text/javascript">'."\n";;
		echo $s;
		echo '</script>'."\n";
	}
	/**
	 * Ejecuta una sentencia SQL
	 *
	 * @param String $sql
	 * @return Object
	 */
	public function Execute($sql){
		if (!empty($sql)){
			return $this->conn->Execute($sql);
		} else {
			echo "<p>Falta SQL</p>";
		}
	}
}
?>
