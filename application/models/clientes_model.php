<?
class Clientes_model extends CI_Model {
		
		var $razonSocial;
		var $rfc;
		var $calle;
		var $numInt;
		var $numExt;
		var $colonia;
		var $cp;
		var $municipio;
		var $estado;
		var $pais;
		var $correoElectronico;
		var $telefono;
		var $porcentajeIVA;
		var $porcentajeIEPS;
		var $porcentajeRetIVA;
		var $porcentajeRetISR;
		var $saldo=0;
		
		public function __constructor(){
			parent::__construct();
		}
		
		public function todos($filtro=""){
			$this->db->select('id,razonSocial,rfc');
			$this->db->like('razonSocial', $filtro );
			$consulta = $this->db->get('Clientes');
			return $consulta;
		}

		public function busca($pId){
			$this->db->where('id', $pId);
			return $this->db->get('Clientes'); 
		}

		public function guarda(){
			$this->db->insert('Clientes',$this);
		}

		public function actualiza($pId){
			$this->db->where('id', $pId);
			$this->db->update('Clientes', $this); 
		}
						
}
	