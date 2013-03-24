<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Condicionespago_model extends CI_Model {

	public function __constructor(){
			parent::__construct();
	}
	
	public function todos(){

		return $this->db->get('CondicionesPago');
	}

}

/* End of file condicionespago_model.php */
/* Location: ./application/models/condicionespago_model.php */