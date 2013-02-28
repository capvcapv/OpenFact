<?
class Unidades_model extends CI_Model {
		
		var $nombre;
		
		public function __constructor(){
			parent::__construct();
		}
		
		public function todos(){
		 	$consulta=$this->db->get('UnidadesVenta');
		 	return $consulta;
		}

		public  function obtiene($pId){
			$this->db->where('id',$pId);
			return $this->db->get('UnidadesVenta');
		}

		public function guarda(){
			$this->db->insert('UnidadesVenta',$this);
		}

		public function actualiza($pId){
			$this->db->where('id', $pId);
			$this->db->update('UnidadesVenta', $this); 
		} 
						
}
	