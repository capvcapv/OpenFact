<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sucursales extends CI_Controller {

	public function index()
	{
		$this->load->view('sucusales_view');
	}

	public function guarda(){
		$this->load->model('Sucursales_model');
		$this->Sucursales_model->nombre=$this->input->post('nombre');
		$this->Sucursales_model->domicilio=$this->input->post('domicilio'); 
		$this->Sucursales_model->guarda();
	}

	public function todos($pNombre=''){
		$this->load->model('Sucursales_model');
		echo json_encode($this->Sucursales_model->todos($pNombre));
	}

	public function sucursal($pId){
		$this->load->model('Sucursales_model');
		$this->Sucursales_model->id=$pId;
		echo json_encode($this->Sucursales_model->obtiene());
	}

	public function actualiza(){
		$this->load->model('Sucursales_model');
		$this->Sucursales_model->nombre=$this->input->post('nombre');
		$this->Sucursales_model->domicilio=$this->input->post('domicilio');
		$this->Sucursales_model->actualiza();
	}

}

