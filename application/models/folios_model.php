<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Folios_model extends CI_Model {
		
		var $serie;
		var $folio;
		var $blockfolios;
		var $ocupado;
		
		public function __constructor(){
			parent::__construct();
		}

		public function guarda(){
			$this->db->insert('Folios',$this);
		}

		public function elimina($pBlock){
			$this->db->where('blockfolios', $pBlock);
			$this->db->delete('Folios');
		}
		
		public function obtener($pBlock){
			$this->db->where('blockfolios', $pBlock);
			return $this->db->get('Folios');	
		}
						
}
	