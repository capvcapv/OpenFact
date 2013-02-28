<?
class Productos_model extends CI_Model {
		
		var $codigo;
		var $nombre;
		var $descripcion;
		var $precio1;
		var $precio2;
		var $unidad;
		var $porcentajeIVA;
		var $porcentajeIEPS;
		var $porcentajeRetIVA;
		var $porcentajeRetISR; 

		public function __constructor(){
			parent::__construct();
		}
		
		public function todos($pNombre=''){
			$this->db->select('codigo,nombre,precio1');
			$this->db->like('nombre', $pNombre);
			$consulta=$this->db->get('Productos');
			return $consulta;
		}	

		public function busca($pCodigo){
			$this->db->where('codigo',$pCodigo);
			return $this->db->get('Productos');
		}

		public function guarda(){
			$this->db->insert('Productos',$this);
		}

		public function actualiza($pId){
			$this->db->where('id',$pId);
			$this->db->update('Productos',$this);
		}
}
	