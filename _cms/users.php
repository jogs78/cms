<?php
include("../extras/adodb496a/adodb.inc.php");
session_start();
class Users
{
	/**
	 * Variables modificables de la BD
	 * @access Protected
	 * @var String
	 */
	protected $user = "content2_root";
	protected $pass = "content2_password";
	protected $db	= "content2";
	protected $host	= "localhost";
	
	protected $conn;
	
	public function Users(){
		$this->conn = ADONewConnection('mysql');  # create a connection
		$this->conn -> PConnect($this->host,$this->user,$this->pass,$this->db);
		//$this->conn->debug=true;
	}
	public function lsusuarios(){
		if ( $_SESSION['permisos'] == 0 ){
			$txt =  "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
			$txt .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
			$txt .= "<head>\n";
			$txt .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n";
			$txt .= "<link href=\"cms.css\" rel=\"stylesheet\" type=\"text/css\"/>\n";
			$txt .= "<link href=\"tables.css\" rel=\"stylesheet\" type=\"text/css\"/>\n";
			$txt .= "<title>Administrador de Usuarios</title>\n";
			$txt .= "</head>\n";
			$txt .= "<body>\n";
			$txt = "<p><a href=\"users.php?option=add\"><img src=\"img/user_add.png\" alt=\"Agregar\" />Agregar Usuario</a></p>\n";
			$txt .= "<p>&nbsp;</p>\n";
			echo $txt;
			$sql = "SELECT * FROM `usuarios` WHERE `usuario` != 'admin';";
			$result = mysql_query($sql);
			if ( mysql_num_rows( $result ) > 0 ){
				$tabla  = "<table border=\"1\">\n";
				$tabla .= "<thead><tr>\n";
				$tabla .= "\t<th width=\"20\">Id</th>\n";
				$tabla .= "\t<th width=\"80\">Usuario</th>\n";
				$tabla .= "\t<th width=\"50\">Admin</th>\n";
				$tabla .= "\t<th width=\"20\"> M </th>\n";
				$tabla .= "\t<th width=\"20\"> X </th>\n";
				$tabla .= "</tr></thead>\n";
				$tabla .= "<tbody>";
				$i = 0;
				while ( $row = mysql_fetch_assoc( $result ) ){
					$tabla .= "<tr>\n";
					$tabla .= "\t<td class=\"c1\">".$row['idusuario']."</td>\n";
					$tabla .= "\t<td>".$row['usuario']."</td>\n";
					#$tabla .= "<td class=\"c1\">".$row['admin']."</td>";
					$tabla .= "\t<td class=\"c1\"><label>\n";
							if ( $row['admin'] == 'y' )
								$check = "checked=\"checked\"";
							else $check = "";
					$tabla .= "\t   <input type=\"checkbox\" name=\"checkbox$i\" id=\"checkbox$i\" value=\"y\" $check disabled=\"true\"/>";
					$tabla .= "</label></td>\n";
					$tabla .= "\t<td><a href=\"users.php?option=m&amp;id=".$row['idusuario']."\"><img src=\"img/user_edit.png\" alt=\"Modificar\" /></a></td>\n";
					$tabla .= "\t<td><a href=\"users.php?option=del&amp;id=".$row['idusuario']."\"><img src=\"img/user_delete.png\" alt=\"Eliminar\" /></a></td>\n";
					$tabla .= "</tr>";
					++$i;
				}
				$tabla .= "</tbody>\n";
				$tabla .= "</table>\n";
				echo $tabla;
				$hola = "hola";
				#echo $hola."->".cambiar($hola);
			} else {
				echo "<p>No existe ningun usuario !! <p>";
			}
		}
	}
	
	public function nuevo(){
		$txt =  "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
		$txt .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
		$txt .= "<head>\n";
		$txt .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n";
		$txt .= "<link href=\"cms.css\" rel=\"stylesheet\" type=\"text/css\"/>\n";
		#$txt .= "<link href=\"tables.css\" rel=\"stylesheet\" type=\"text/css\"/>\n";
		$txt .= "<title>Administrador de Usuarios</title>\n";
		$txt .= "</head>\n";
		$txt .= "<body>\n";
		$txt = "<p>Nuevo Usuario</p>\n<p>&nbsp;</p>\n";
		$txt .= "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"users.php?option=add&amp;action=guardar\" >\n";
		$txt .= "  <table width=\"250\" border=\"0\">\n";
		$txt .= "    <tr>\n";
		$txt .= "      <td width=\"93\">Nombre:</td>\n";
		$txt .= "      <td width=\"94\"><label>\n";
		$txt .= "        <input type=\"text\" name=\"nombre\" id=\"nombre\" />\n";
		$txt .= "      </label></td>\n";
		$txt .= "    </tr>\n";
		$txt .= "    <tr>\n";
		$txt .= "      <td width=\"93\">Usuario:</td>\n";
		$txt .= "      <td width=\"94\"><label>\n";
		$txt .= "        <input type=\"text\" name=\"usuario\" id=\"usuario\" />\n";
		$txt .= "      </label></td>\n";
		$txt .= "    </tr>\n";
		$txt .= "    <tr>\n";
		$txt .= "    <tr>\n";
		$txt .= "      <td width=\"93\">email:</td>\n";
		$txt .= "      <td width=\"94\"><label>\n";
		$txt .= "        <input type=\"text\" name=\"email\" id=\"email\" />\n";
		$txt .= "      </label></td>\n";
		$txt .= "    </tr>\n";
		$txt .= "    <tr>\n";
		$txt .= "      <td>Contrase&ntilde;a:</td>\n";
		$txt .= "      <td><label>\n";
		$txt .= "        <input type=\"password\" name=\"pass\" id=\"pass\" />\n";
		$txt .= "      </label></td>\n";
		$txt .= "    </tr>\n";
		$txt .= "    <tr>\n";
		$txt .= "      <td>Repetir Contrase&ntilde;a:</td>\n";
		$txt .= "      <td><label>\n";
		$txt .= "        <input type=\"password\" name=\"pass2\" id=\"pass2\" />\n";
		$txt .= "      </label></td>\n";
		$txt .= "    </tr>\n";
		$txt .= "    <tr>\n";
		$txt .= "    <td>\n";
		$txt .= "    	Administrador\n";
		$txt .= "    </td>\n";
		$txt .= "    <td><label>\n";
		$txt .= "		<select name=\"permisos\" size=\"1\">\n";
			for ( $i = 1; $i <= 10; $i++){
				$txt .=	"		<option value=\"$i\">$i</option>\n";
			}
		$txt .=	"		</select>\n";
		#$txt .= "      <input type=\"checkbox\" name=\"admin\" id=\"admin\" value=\"y\"/>\n";
		$txt .= "    </label>    </td>\n";
		$txt .= "    </tr>\n";
		$txt .= "  </table>\n";
		$txt .= "  <p>\n";
		$txt .= "    <label>\n";
		$txt .= "    <input type=\"submit\" name=\"button\" id=\"button\" value=\" [ Agregar ] \" />\n";
		$txt .= "    </label>\n";
		$txt .= "  </p>\n";
		$txt .= "</form>\n";
		$txt .= "</body>\n";
		$txt .= "</html>";
		echo $txt;
	}
	public function guardar(){
		$sql = "";
			//if ( isset($_POST['admin']) ){ $admin = 'y'; } else { $admin = 'n'; }
			if ( $_POST['pass'] === $_POST['pass2'] && isset($_POST['usuario']) ){
				$sql = "INSERT INTO `usuarios` VALUES (null , '".$_POST['nombre']."','".$_POST['usuario']."', '".md5($_POST['pass'])."','$_POST[email]', '$_POST[permisos]' );";
				echo $sql;
				$this->conn->Execute($sql);
			} else {
				$txt  = "<p>Las contrase&ntilde;as no son iguales !! </p>";
				$txt .= "<p>&nbsp;</p>\n";
				$txt .= "<p><a href=\"users.php?option=add&amp;\">Agregar Usuario</p>\n";
				$txt .= "<p>&nbsp;</p>\n";
				echo $txt;
			}
	}
	private function cambiar($pass){
		$tam = strlen($pass);
		$abc = "1234567890";
		$otro = "";
			for ( $i = 0; $i < $tam; $i++ ){
				$otro .= $abc[rand(0,10)];
			}
		return $otro;
	}
	public function inicio(){
		$txt =  "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
		$txt .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
		$txt .= "<head>\n";
		$txt .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n";
		$txt .= "<title>Administrador de Usuarios</title>\n";
		$txt .= "<style type=\"text/css\">\n";
		$txt .= "<!--\n";
		$txt .= ".Estilo1 {\n";
		$txt .= "	color: #0066CC;\n";
		$txt .= "	font-weight: bold;\n";
		$txt .= "	font-family: Verdana, Arial, Helvetica, sans-serif;\n";
		$txt .= "}\n";
		$txt .= ".Estilo2 {\n";
		$txt .= "	font-family: Verdana, Arial, Helvetica, sans-serif;\n";
		$txt .= "	font-size: 12px;\n";
		$txt .= "}\n";
		$txt .= "-->\n";
		$txt .= "</style>\n";
		$txt .= "</head>\n";
		$txt .= "<body>\n";
		$txt .= "<p class=\"Estilo1\">Administrador de Usuarios</p>\n";
		$txt .= "<p>&nbsp;</p>\n";
		$txt .= "<p class=\"Estilo2\"><a href=\"users.php?option=add\">Agregar Usuario</a><br />\n";
  		$txt .= "<a href=\"users.php?option=del\">Borrar Usuario</a><br />\n";
  		$txt .= "<a href=\"users.php?option=m\">Modificar Usuario</a></p>\n";
		$txt .= "</body>\n";
		$txt .= "</html>\n";
		echo $txt;
	}
}

if ( $_SESSION["INCMS"] === "OK" ){
	//CREANDO OBJETO
	$usr = new Users();
	if ( isset($_GET['option']) ){
		switch($_GET['option']){
			case 'add':
				switch($_GET['action']){
					case 'guardar':
						$usr->guardar();
						break;
					default:
						$usr->nuevo();
						break;
				}
				break;
			case 'del':
				break;
			case 'm':
				break;
			default:
				$usr -> inicio();
				break;
		}
	}else{
		$usr -> inicio();
	}
} else {
	header("Location: index.php");
}
?>
