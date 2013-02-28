<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ClienteDocumento_model extends CI_Model {

	var $id;
	var $cliente;
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

	public function __construct()
	{
		parent::__construct();
		
	}

	public function obtiene(){

		$this->db->where('id', $this->id);
		$consulta=$this->db->get('ClienteDocumento_model');
	}

	public function guarda(){

		$this->db->set('cliente',$this->cliente);
		$this->db->set('razonSocial',$this->razonSocial);
		$this->db->set('rfc',$this->rfc);
		$this->db->set('calle',$this->calle);
		$this->db->set('numInt',$this->numInt);
		$this->db->set('numExt',$this->numExt);
		$this->db->set('colonia',$this->colonia);
		$this->db->set('cp',$this->cp);
		$this->db->set('municipio',$this->municipio);
		$this->db->set('estado',$this->estado);
		$this->db->set('pais',$this->pais);

		$this->db->insert('ClienteDocumento_model');
	}
}

/* End of file clienteDocumento_model.php */
/* Location: ./application/models/clienteDocumento_model.php */