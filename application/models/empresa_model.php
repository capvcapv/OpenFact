<?
class Empresa_model extends CI_Model {
		
		var $nombre;
		var $rfc;
		var $calle;
		var $numInt;
		var $numExt;
		var $colonia;
		var $cp;
		var $municipio;
		var $estado;
		var $pais;
		var $regimenFiscal;
		var $porcentajeIVA;
		var $porcentajeIEPS;
		var $porcentajeRetIVA;
		var $porcentajeRetISR;
		
		public function __constructor(){
			parent::__construct();
		}
		
		public function todos(){
			$consulta = $this->db->get('Empresa'); 
			return $consulta;
		}

		public function guarda(){
			$this->db->insert('Empresa',$this);
		}
		
		public function actualiza($pId){
			$this->db->where('id',$pId);
			$this->db->update('Empresa', $this); 
		}				
}
	