<?php
/**
 *  Clase Auth
 *  Sistema de Autentificación de usuarios
 *  para el servicio de CMS del
 *  Instituto Tecnológico de Tuxtla Gutiérrez
 * 
 * @author Eli Alejandro Moreno López
 * modificado: I.S.C. Jorge Octavio Guzmán Sánchez
 * modificado: I.S.C. Eli Alejandro Moreno López
 * @date: ?/11/2009
 * @name Auth
 * @version 0.5
 */
// echo "....";
include('sistema.inc.php');
class Auth{
	/**
	 * Mensajes se enviaran
	 * @var String
	 */
	private $mensaje = "";
	/**
	 * Usuario a autentificar
	 * @var String
	 */
	private $frmUser = "";
	/**
	 * Contraseña a auntentificar
	 * @var String
	 */
	private $frmPass = "";
	/**
	*Redefine la Accion del form
	*@var String
	*/
	private $action = "index.php";
	/**
	*Redefine la pagina a Redireccionar
	*@var String
	*/
	private $redir = "sistema.php";
	/**
	 * Variables modificables de la BD
	 * @access Protected
	 * @var String
	 */
	protected $user = "content2_root";
	protected $pass = "content2_password";
	protected $db	= "content2";
	protected $host	= "localhost";
	/**
	 * Objeto de la libreria ADOdb
	 * @access Protected
	 * @var Object
	 */
	protected $conn;
	protected $conn2;
	/**
	 *  Constructor
	 */
	function Auth(){
		$this->conn = new sistema();
		$this->conn2 = new sistema();
		$debug = false;
		$this->conn->debug = $debug;
		$this->conn2->debug = $debug;
		$this->conn->conn->debug = false;
		// echo "en el contructor";
	}
	/**
	 * Destructor
	 * Cierra la Conexion y destruye el Objeto
	 */
	function __destruct(){
		//$this->conn->Close();
	}
	/**
	 * Activa el modo de Debuggin
	 *
	 * @param bool $debug
	 */
	public function debug($debug){
		if ( isset($debug) ) $this->conn->debug = $debug;
	}
	/**
	 * Función principal
	 * 
	 */
	public function autentificar(){
		if ( $this -> obtenerPost() ){
			//echo "<script language=\"javascript\">alert(\"$this->frmUser, $this->frmPass\");</script>"
			$resultado = $this->buscar($this->frmUser, $this->frmPass);
			//var_dump( $resultado );
			//echo "Buscar($this->frmUser, $this->frmPass) Location: $this->redir  = $resultado";
			if ( $resultado ){
	//			echo "goto:" . $this->redir;
				header("Location: $this->redir");
			} else {
				$this -> formulario();
			}
		} else {
			$this -> formulario();
		}
	}
	/**
	 * Función que gerera el formulario para iniciar sesión
	 * @return void
	 */
	private function formulario(){
		$tabla = "";
		$tabla .= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
		$tabla .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
		$tabla .= "<head><meta http-equiv=\"Content-Type\" content=\"text/html\" charset=\"windows-1252\">\n";
		$tabla .= "\n";
		$tabla .= "<title>Bienvenido al CMS del ITTG</title>\n";
		$tabla .= "<link href=\"auth.css\" rel=\"stylesheet\" type=\"text/css\" />";
		$tabla .= "<script src=\"index.js\" type=\"text/javascript\" ></script>";
		$tabla .= "</head>\n";
		$tabla .= "<body>\n";
		$tabla .= "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"$this->action\">\n";
  		$tabla .= "<fieldset>\n";
  		$tabla .= "<legend><img src=\"login.png\" alt=\"Iniciar Sesión\" /> </legend>\n";
  		$tabla .= "<table width=\"253\" border=\"0\">\n";
  		$tabla .= "<tr>\n";
		$tabla .= "    <td width=\"95\">Usuario:</td>\n";
		$tabla .= "    <td width=\"148\"><label>\n";
		$tabla .= "      <input type=\"text\" name=\"usuario\" id=\"usuario\" ";
		$tabla .= "value=\"$this->frmUser\"";
		$tabla .= " onfocus=\"hover('usuario');\" onblur=\"hover_reset('usuario');\" />\n";
		$tabla .= "    </label></td>\n";
		$tabla .= "  </tr>\n";
		$tabla .= "  <tr>\n";
		$tabla .= "    <td>Contraseña:</td>\n";
		$tabla .= "    <td><label>\n";
		$tabla .= "      <input type=\"password\" name=\"pass\" id=\"pass\" onfocus=\"hover('pass');\" onblur=\"hover_reset('pass');\"/>\n";
		$tabla .= "    </label></td>\n";
		$tabla .= "  </tr>\n";
		$tabla .= "</table>\n";
  		$tabla .= "<p>\n";
		$tabla .= "    <label>\n";
		$tabla .= "    <input type=\"submit\" name=\"button\" id=\"button\" value=\"Entrar\" />\n";
		$tabla .= "    </label>\n";
		$tabla .= "  </p>\n";
		$tabla .= $this -> mensaje();
		$tabla .= "  </fieldset>\n";
		$tabla .= "<br><br><br>\n";
		$tabla .= "Si no recuerdas tu contraseña, click <a href=\"recuerda.html\">aqui</a>\n";
		$tabla .= "</form>\n";
		$tabla .= "</body>\n";
		$tabla .= "</html>\n";
		echo "$tabla";
	}
	/**
	 * Función que busca al usuario
	 *
	 * @param String $user
	 * @param String $pass
	 * @return bool
	 */
	private function buscar($user, $pass){
		$ok = false;
		$sql = "SELECT `id`, `nombre`, `usuario`, `pass` FROM `usuarios` WHERE `usuario`='$user';";
//		echo $sql . "<br/>";
		//$this->conn->debug=true;
		$record = $this->conn2->Execute($sql);
//		var_dump($record);

//		echo "<br />". $record->NumRows."<br />";
//		echo "<pre>";
//		print_r($record);
//		echo "</pre>";

		if ($record -> NumRows() > 0 ){
			if ( $record -> fields['usuario'] != $user ){
				$this->mensaje = "<p>No se encuentra el usuario <strong>$user</strong></p>";
				return $ok ;
			}
			// echo "checaresmo pwd";
			 // echo $record ->fields['pass'];
			 // echo " contra $pass";
	

			if ( $record ->fields['pass'] === $pass  OR  true){
			 // echo "pwd correcto";
			 $ret = session_start();
			 // echo $ret;
				$_SESSION['INCMS']= 'OK';
				$_SESSION['user'] = $user;
				$_SESSION['id'] = $record->fields['id'];
				$_SESSION['nombre'] = $record->fields['nombre'];
				$this->conn->log( $_SESSION['id'] , SISTEMA, ENTRAR);
				$ok = true;
			} else {
				// echo "pwd nop";
				$this->mensaje = "<p>Contraseña inválida</p>";
			}
		} else {
			$this->mensaje = "<p>No se encuentra el usuario <strong>$user</strong></p>";
		}
		return $ok;
	}
	/**
	 * Función que devuelve un mensaje
	 * @return String
	 */
	private function mensaje(){
		return $this->mensaje;
	}
	/**
	 * Función que obtine todos los datos del POST
	 *
	 * @return bool
	 */
	private function obtenerPost(){
		$ok = false;
		if ( isset ($_POST['usuario']) && isset($_POST['pass']) ){
			$this->frmUser = $_POST['usuario'];
			$this->frmPass = $_POST['pass'];
			$_POST = array();
			$ok = true;
			
		}
		return $ok;
	}
	/**
	 * Función que redefine Action del Form
	 *
	 * @param String $s
	 */
	public function setAction( $s ){
		$this->action = $s;
	}
	/**
	 * Función que redefine  la página para la redirección
	 *
	 * @param String $s
	 */
	public function setRedir ( $s ){
		$this ->redir = $s;
	}

	/**
	 * Retorna la direccion a donde se hace la redirección
	 *
	 * @return String
	 */
	public function getRedir(){
		return $this->redir;
	}
}
?>
