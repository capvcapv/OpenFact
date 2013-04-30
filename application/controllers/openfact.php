<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Openfact extends CI_Controller {

	
	public function index()
	{
		$this->load->view('openfact_view');
	}

}
