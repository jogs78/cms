<?php
	if(! class_exists("firephp")) require_once('FirePHPCore/FirePHP.class.php');
	include_once('adodb496a/tohtml.inc.php');
	include_once("adodb496a/adodb.inc.php");
	include_once('adodb496a/adodb-pager.inc.php');

class clase{
	protected $firephp ;
	protected $debug=false;
	protected $nivel="usuario";
	protected $user;
	protected $pass;
	protected $db;
	protected $host;
	protected $puede_salir = 0;
	protected $conn ;
	public $error;
	protected $accion;
	protected $n1;
	protected $n2;
	protected $sig_accion;
	protected $ant_accion;
	protected $listado;
	protected $formulario = "no_especificado.php";
	protected $campos;
	protected $variables;
	protected $tabla;
	protected $vista;
	protected $properties= array();
//  protected $_id;
	
	/**
	 * Genera una lista de todos los datos
	 * que se han pasado por $_GET
	 */
	 public function debug($v=true){
		$this->debug=$v;
		$this->conn->debug=$v;
	 }

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
//	public function log($str, $f=__FILE__, $l=__LINE__){
	public function log($str, $f, $l){
		$this->firephp->log( "$f:$l " . $str);
	}

	public function GetNivel(){
		return $this->nivel;
	}
	
	public function __get($propName) {
         return $this->properties[$propName];
    }

     public function __set($propName, $propValue) {
         $this->properties[$propName] = $propValue;
    } 

	public function tipo_lista(){
		return 't';
	}
	
	public function _on_change(){
		return ' ';
	}
	function __construct(){
		GLOBAL $__host;
		GLOBAL $__user;
		GLOBAL $__pwd;
		GLOBAL $__db;
		
		if ($__host!="")$this->host=$__host;
		if ($__user!="")$this->user=$__user;
		if ($__pwd!="")$this->pass=$__pwd;
		if ($__db!="")$this->db=$__db;
		$this->conn = ADONewConnection('mysqli');  # create a connection

//		echo "PConnect($this->host,$this->user,$this->pass,$this->db)";
		$this->conn -> PConnect($this->host,$this->user,$this->pass,$this->db);
 		
		$this->listado = "";
		$this->variables =explode(',' , $this->clave . "," . $this->campos. "," . $this->campos2 );
		$this->firephp = FirePHP::getInstance(true);

	}
	
	function __destruct(){
		$this->conn->Close();
	}
	protected function buscar(){
		if(isset($_GET["id"])) $id=$_GET["id"];
		elseif(isset($_POST["id"])) $id = $_POST["id"];
		$clv = $this->clave;
	    $sql = "SELECT * FROM $this->tabla WHERE $clv = '$id'; ";
		if($this->debug) echo "<hr><b>$sql</b><hr>";
		$rs = $this->conn->Execute($sql);
		if (!$rs){
			$this->error = $this->conn->ErrorMsg() . " en el sql:<br><b>$sql</b>";
		}elseif($rs->RecordCount()==0){
			$this->error = "No se encontro registro con en el sql:<br><b>$sql</b>";
		}else{
			$i=0;
			foreach( $this->variables as $variable ) {
				$this->properties[$variable]=$rs->fields["$variable"];
				$i++;
			}
		}
		$this->log("BUSCAR($sql) campos = $i",__FILE__ , __LINE__ );	
	}

	protected function eliminar(){
		//$this->conn->debug=true;
		if(isset($_GET[$this->clave])) $id=$_GET[$this->clave];
		elseif(isset($_POST[$this->clave])) $id = $_POST[$this->clave];
		$clv = $this->clave;
		$sql = "DELETE FROM $this->tabla WHERE $clv = '$id'; ";
		if($this->debug) echo "<hr><b>$sql</b><hr>";
		if ($this->conn->Execute($sql) === false) {
			$this->error =  'Error al borrar: '.$this->conn->ErrorMsg() . " en el sql:<br><b>$sql</b>";
		}		
	}

	protected function agregar(){
		$this->firephp->dump('GET', $_GET);  // or FB::
		$this->firephp->dump('POST', $_POST);  // or FB::
		$this->firephp->dump('SEESION', $_SESSION);  // or FB::		
		$values ="";
		$cont = 0;
		foreach( explode("," , $this->campos)  as $variable ) {
			if($this->properties[$variable]=="") continue;
			if ($cont >0){
				$fields .= ",";
				$values .= ",";
			}			$cont++;
			$fields .= $variable;
			$values .= "'" . $this->properties[$variable] . "'" ;
		}
		$sql="INSERT INTO $this->tabla ($fields) VALUES($values);";
		if($this->debug) echo "<hr><b>$sql</b><hr>";
		//$this->conn->debug=true;
		if ($this->conn->Execute($sql) === false) {
			$this->error =  '<hr>Error al insertar: '.$this->conn->ErrorMsg() . " en el sql:<br><b>$sql</b>";
		}		
	}

	protected function editar(){
		//$this->conn->debug=true;
		if(isset($_GET[$this->clave])) $id=$_GET[$this->clave];
		elseif(isset($_POST[$this->clave])) $id = $_POST[$this->clave];
		$clv = $this->clave;
		
		$sql = "UPDATE $this->tabla SET " ;		
		$cont = 0;
		foreach( explode("," , $this->campos)  as $variable ) {
			if($this->properties[$variable]=="") continue;
			if ($cont >0) $sql .= ", ";
			$cont++;
			$sql .= "$variable = '" . $this->properties[$variable] . "'";
		}
	    $sql .= " WHERE $clv = '$id'; ";
		if($this->debug) echo "<hr><b>$sql</b><hr>";
		if ($this->conn->Execute($sql) === false) {
			$this->error =  'Error al insertar: '.$this->conn->ErrorMsg() . " en el sql:<br><b>$sql</b>";
		}		
	}
	
	protected  function cargar_get(){
		foreach( $this->variables as $variable ) {
			if(isset($_GET[$variable])){
				$this->properties[$variable]=$_GET["$variable"];
			}else{
				$this->properties[$variable]=' ';
			}
			//unset($_GET["$variable"]);
		}
	}
	protected  function cargar_post(){
		foreach( $this->variables as $variable ) {
			if(isset($_POST[$variable])){
				$this->properties[$variable]=$_POST["$variable"];
			}elseif(isset($_GET[$variable])){
				$this->properties[$variable]=$_GET["$variable"];
			}
			
			//unset($_POST["$variable"]);
			$variable="sistema";
			if(isset($_POST[$variable])){
				$this->properties[$variable]=$_POST["$variable"];
			}elseif(isset($_GET[$variable])){
				$this->properties[$variable]=$_GET["$variable"];
			}
			
		}
	}		
	public function procesar(){
		$this->error="";
		$this->log("en procesar switch(" . $this->Getaccion() . ")",__FILE__ , __LINE__ );
		//agregar default ...
		switch($this->Getaccion()){
			case 'agregar':
				$this->cargar_post();
				$this->agregar();
				$this->puede_salir=1;
				$vista = $this->listado;			
				break;
			case 'eliminar':
				$this->cargar_post();
				$this->eliminar();
				$this->puede_salir=1;
				$vista = $this->listado;			
				break;
			case 'editar':
				$this->cargar_post();
				$this->editar();
				$this->puede_salir=1;
				$vista = $this->listado;			
				break;
			case 'preagregar':
				$this->puede_salir=0;
				$vista = $this->formulario;
				break;
			case 'preeditar':
			case 'preeliminar':
			case 'ver':
				$this->puede_salir=0;
				$this->buscar();
				$vista = $this->formulario;
				$this->log("procesar()=$vista",__FILE__ , __LINE__ );	
			break;
			case 'listar':
				$this->puede_salir=1;
				$this->log("case listar(" . $this->listado . ")",__FILE__ , __LINE__ );
				$vista = $this->listado;			
			break;
		}
		if($this->error!="") $vista = "sistema/error.php";
		return $vista;
	}
	
	function PuedeSalir(){
		return $this->puede_salir;
	}
	
	function Execute($sql){
		return $this->conn->Execute($sql);
	}
	protected function limpiar(){
		reset($_POST);
		while (list ($clave, $val) = each($_POST)) {
			$_POST["$clave"]=htmlentities($val);
		}
		reset($_GET);
		while (list ($clave, $val) = each($_GET)) {
			$_GET["$clave"]=htmlentities($val);
		}	
	}		
	public function Setaccion($acc){
		$this->log("Setaccion($acc)",__FILE__ , __LINE__ );
//		$this->log("Setaccion($acc)");
		//agregar default ...
		switch($acc){
			case 'agregar':		$this->sig_accion='listar'; break;
			case 'eliminar':		$this->sig_accion='listar'; break;
			case 'editar':	$this->sig_accion='listar'; break;
			case 'preagregar':	$this->sig_accion='agregar'; break;
			case 'preeditar':	$this->sig_accion='editar'; break;
			case 'preeliminar':	$this->sig_accion='eliminar'; break;
			case 'ver':	$this->sig_accion='listar'; break;
			default: $acc = 'listar'; $this->sig_accion='listar';  break;
		}
		$this->accion = $acc;
	}
	public function GetSigaccion(){
		return $this->sig_accion;
	}
	public function Getaccion(){
		return $this->accion;
	}	
	public function DISABLED(){
		//agregar default ...
		switch($this->Getaccion()){
			case 'agregar':
			case 'borrar':
			case 'preagregar':
			case 'actualizar':
				$ret = "";
			break;
			case 'preeditar':
			case 'preeliminar':
				$ret = ' readonly="true" ';
			break;
		}
		return $ret;
	}
	public function NAccion_(){
		//agregar default ...
		switch($this->Getaccion()){
			case 'agregar': $acc = "listar"; break;
			case 'borrar': $acc = "listar"; break;
			case 'preagregar': $acc = "agregar"; break;
			case 'actualizar': $acc = "listar"; break;
			case 'preeditar': $acc = "editar"; break;
			case 'preeliminar': $acc = "eliminar"; break;
		}
		return $acc;
	}
	
	public function Getconn(){ return $this->conn;}
	
	public function Catalogo($sql,$debug=false){
		$this->conn->debug= $debug;
		return $this->conn->catalogo($sql);
	}
	
	public function Catalogoh($sql){ 
		return $this->conn->catalogoh($sql);
	}
	
	public function GetValue($sql, $debug = false){ 
		return $this->conn->GetValue($sql,$debug); 
	}
	
	public function menu(){
		
	}	
	public function footer(){
		$ret = "";
		$ret .= "				<input type=\"submit\" onclick=\"SetAccion('preagregar')\" value=\"AGREGAR\"/>\n";
		$ret .= "				<input type=\"submit\" onclick=\"SetAccion('preeliminar')\" value=\"ELIMINAR\"/>\n";
		$ret .= "				<input type=\"submit\" onclick=\"SetAccion('preeditar')\" value=\"MODIFICAR\"/>\n";
		$ret .= "				<input type=\"submit\" onclick=\"SetAccion('ver')\" value=\"VISUALIZAR\"/>\n";
		return $ret;
	}
	public function footer2(){
	}
	public function chk(){
		return '';
	}
	public function chk1(){
		return 'o';
	}
	public function titulo2(){
		return false;
	}
}

?>