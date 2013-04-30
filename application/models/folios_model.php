<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Folios_model extends CI_Model {
		
		var $id;
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
		
		public function obtener($serie,$folio){
			$this->db->where('serie', $serie);
			$this->db->where('folio', $folio);
			return $this->db->get('Folios');	
		}

		public function foliosDisponibles(){
			$this->db->where('ocupado',0);
			return $this->db->get('Folios');
		}

		public function actualiza(){
			$this->db->where('id', $this->id);
			$this->db->update('Folios', $this);
		}
						
}
	