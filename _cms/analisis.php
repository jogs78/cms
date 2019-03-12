<?php
include ('extras/adodb496a/adodb.inc.php');	   # load code common to ADOdb 
class cms{
	protected $conn;
	protected $user;
	protected $pwd;
	protected $db;
	protected $host;
	protected $hoy;
	private $is_local;
	private $ip_visita ;
	private $cid;
	private $tipo;
	private $id;
	private $titulo;
	private $texto;
	private $imagenes;
	public $visitas_unicas;
	public $visitantes;
	public $vhead;
	public $vfoot;
	public $head;
	private $menu="";
	private $script="";
	private $indent="";
	private $deep=0;
	private $_title="";
	
	function __construct(){
	}
	function __destruct(){	}
	public function debug($edo = true){
	}

	public function title(){
	}
	public function tosearch(){
	}
	private function isnew( $fecha_n, $nuevo){
	}
	public function encuestas(){
	}
	public function tecavisos(){
	}
	public function tecnoticias(){
	}	
	public function visitantes_activos() {
	 }
	public function printact(){
	}
	public function printnum(){
	}
	public function send_cookies(){
	}
	public function unicas($visitas_unicas){
	}
	public function encabezado( $normal = true ){
	}
	protected function cl($cadena){
	}
	protected function cl2($cadena){
	}
	protected function item($idi ){
	}
	public function navegacion2($inicio = true){
	}
	public function navegacion( $inicio = true ){
	}
	private function navegacion_foot(  ){
	}
	public function settipo($tipo="noticia", $id=-1){ $this->tipo = $tipo; $this->id = $id; }
	public function cargar_title(){
	}
	public function cargar(){
	}
	public function tit(){ echo $this->titulo; }
	public function txt(){ echo $this->texto; }
	public function img(){ echo $this->imagenes; }
	public function head(){
	}
	public function url($id=-1){
	}
	public function cargar_noticias(){
	}
	public function cargar_anuncios(){
	}
	private function generateRandString($numChars){
	}
	public function cargar_contacto(){
	}
	public function validation_foot(){
	}
	public function google_analytics(){
	}
	public function anunciosg( $orientacion = "derecha" ){
	}
//	public function cargar_comentario($email, $titulo, $comentario, $nombre, $txtval){
	public function cargar_comentario(){
	}
//--------------------
	protected function item2($idi ){
	}
	public function fmenu(){//mapa del sitio
	}

	public function tosearch_2(){//es la que creo debo modificar
	}

	public function tosearch2(){//es la que creo debo modificar
	}
}
?>
