<?php 
//include_once('conf.inc.php');
require_once('fpdf/fpdi.php'); 
if(! class_exists("firephp")) require_once('FirePHPCore/FirePHP.class.php');
include_once('adodb496a/tohtml.inc.php');
include_once("adodb496a/adodb.inc.php");
include_once('adodb496a/adodb-pager.inc.php');

	
class wpdf{
	protected $firephp;
	protected $debug=false;
	protected $user;
	protected $pass;
	protected $db;
	protected $host;	
	protected $file_name;
	protected $file_size;
	protected $file_type;	 
	protected $file_tmp_name;
	protected $pdf;
	protected $maxx;
	protected $maxy;
	protected $id_depto;
	protected $cfejercicio;
	protected $conn;
	protected $error="";	
	protected $paginas=1;	
	protected $properties= array();
	protected $dy = -0.0;
	protected $alineacion = "L";
	protected $cur_pag;
	 
	
	public function __get($propName) {
         return $this->properties[$propName];
    }

    public function __set($propName, $propValue) {
         $this->properties[$propName] = $propValue;
    } 
	
 	public function log($str, $f, $l){
		$this->firephp->log( "$l:$f " . $str);
	}

	function __construct(){
		GLOBAL $__host;
		GLOBAL $__user;
		GLOBAL $__pwd;
		GLOBAL $__db;
		
		if ($__host!="")$this->host=$__host; else $this->host="localhost";
		if ($__user!="")$this->user=$__user; else $this->user="intranet";
		if ($__pwd!="")$this->pass=$__pwd; else $this->pass="intranet";
		if ($__db!="")$this->db=$__db; else $this->db="intranet";
		
		$this->conn = ADONewConnection('mysqli');  # create a connection
		$this->conn->PConnect($this->host,$this->user,$this->pass,$this->db);
	
//		$this->file_name     = "bco.pdf"; //planeacion/pta....
//		$this->file_type     = "application/x-pdf";	 
//		$this->file_tmp_name = $_FILES[$this->index]['tmp_name'];
//		$this->file_size     = $_FILES[$this->index]['size'];
			
		 //hoja carta = 21.59 x 27.94 centimetros = 2550 x 3300 pixels "P" VERTICAL
		if($this->alineacion=="L"){  //"L" LandScape
			$this->maxy=21.59;
			$this->maxx=28.94;
		}else{
			$this->maxx=21.59;
			$this->maxy=28.94;		
		}
		$this->pdf =& new FPDI($this->alineacion,"cm"); 
		$this->firephp = FirePHP::getInstance(true);

	}
	
	protected function load_data(){
	}
	

	function mostrar(){
		$this->log("mostrar() ",__FILE__ , __LINE__ );	
		$this->firephp->dump('this', $this);  // or FB::
		$this->load_data();
		$this->pdf->setSourceFile($this->file_name);
		for($this->cur_pag=1;$this->cur_pag<=$this->paginas;$this->cur_pag++){
			$this->pagina();
			if($this->debug) $this->marcar();
			$this->pdf->SetFont('Arial','',12);

			$this->rellenar();
		}
		$this->pdf->OutPut($this->file_name,"I"); 
/*	 
	* I: Navegador.
    * D: Download.
    * F: Guarda en uno local.
    * S: Guarda en una cadena. 
*/
		//$pdf->OutPut(); 		
	}

	protected function rellenar(){
		$this->log("rellenar() ",__FILE__ , __LINE__ );	
//		$this->rellenar_general($this->cur_pag);
//		$this->rellenar_pagina ($this->cur_pag);
	}
	protected function pagina(){
		$this->log("pagina() ",__FILE__ , __LINE__ );			
		$this->pdf->AddPage(); 
		$tplIdx = $this->pdf->importPage($this->cur_pag); 
		$this->pdf->useTemplate($tplIdx, 0, 0); 
	}

	private function texto($ini){
		for ($x=0; $x<$this->maxx; $x+=0.5){
			$this->pdf->Text($x, 1.2+$ini, $x);
		} 
		for ($y=0; $y<$this->maxy; $y+=0.5){
			$this->pdf->Text(1.2+$ini, $y, $y);
		} 
	}
	
	private function marcar(){
		$this->pdf->SetLineWidth(0.01);
		$this->pdf->SetDrawColor(255,0,0); 
		$this->cuadricular(0.5);
		$this->pdf->SetLineWidth(0.02);
		$this->pdf->SetDrawColor(0,0,255); 
		$this->cuadricular(1);
		$this->pdf->SetLineWidth(0.03);
		$this->pdf->SetDrawColor(0,255,0); 
		$this->cuadricular(5);
		$this->pdf->SetFont('Arial','B',5);	
		$this->texto(0);	
		$this->texto(10);	
		$this->texto(20);	
	}	
	private function cuadricular($inc=0.5){
		for ($x=0; $x<$this->maxx; $x+=$inc){
			$this->pdf->Line($x, 0, $x, $this->maxy);
		} 
		for ($y=0; $y<$this->maxy; $y+=$inc){
			$this->pdf->Line(0, $y, $this->maxx, $y);
		} 
	}	
}

?>