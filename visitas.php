<?php
	class mysql{
	
		var $server = 'localhost';
		var $user_db = 'content2_root';
		var $password = 'content2_password';
		var $data_base = 'content2';
		var $error = '';
		var $error1 = "<h1><samp style='color:#990000'>No se pudo hacer la conexion</samp></h1>";
		var $error2 = "<h1><samp style='color:#990000'>No se pudo conectar con la base de datos</samp></h1>";

		var $conexion, $select, $value;
	
		function connect(){
			$this->conexion =@mysql_connect($this->server, $this->user_db, $this->password) ;// or die($this->error1);
			if($this->conexion == false){
				header("Location: http://pruebas.ittg.edu.mx/");
				die("");
			}
			$this->value = true;
		}

		
		function close(){
		@mysql_close($this->conexion);
		$this->value = false; return true;
		}
		
		function select_db(){
		$this->select = @mysql_select_db($this->data_base,$this->conexion) or die($this->error2);
		}
		
		function query($query){
		$result = @mysql_db_query($this->data_base,$query) or mysql_error();
		return $result;
		}
		
		function fetch_array($resource){
		 if( !is_resource( $resource ) )
		 {
			mysql_error();
		 }
		 
			$result = @mysql_fetch_array($resource);
			return $result;
		}
	
	}
?>
