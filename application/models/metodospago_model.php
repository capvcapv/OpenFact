<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Metodospago_model extends CI_Model {

	public function todos(){
		
		return $this->db->get('MetodosPago');
	}

}

/* End of file metodosPago_model.php */
/* Location: ./application/models/metodosPago_model.php */