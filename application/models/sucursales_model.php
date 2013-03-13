<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sucursales_model extends CI_Model {

	var $id;
	var $nombre;
	var $domicilio;

	public function __constructor(){
		parent::__construct();
	}

	public function todos($pNombre=''){
		$this->db->select('id,nombre,domicilio');
		$this->db->like('nombre',$pNombre);
		return $this->db->get('Sucursales');
	}

	public function obtiene(){
		$this->db->where('id',$this->id);
		return $this->db->get('Sucursales');
	}

	public function guarda(){
		$this->db->set('nombre',$this->nombre);
		$this->db->set('domicilio',$this->domicilio);
		$this->db->insert('Sucursales');
	}

	public function actualiza(){
		$this->db->where('id', $this->id);
		$this->db->update('Sucursales',$this);
	}

}

