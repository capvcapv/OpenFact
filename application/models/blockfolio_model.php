<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blockfolio_model extends CI_Model {
		
		var $serie;
		var $folioInicial;
		var $folioFinal;
		var $aprobacion;
		var $inicioVigencia;
		var $finVigencia;
		var $cbb;
		
		public function __constructor(){
			parent::__construct();
		}

		public function guarda(){
			$this->db->insert('BlockFolios',$this);
			return $this->db->insert_id();
		}

		public function elimina($pId){
			$this->db->delete('BlockFolios'.array('id'=>$pId));
		}

		public function obtener($pId){
			$this->db->where('id',$pId);
			return $this->db->get('BlockFolios');
		}
		
		public function obtenerTodos(){
			return $this->db->get('BlockFolios');
		}
						
}
	