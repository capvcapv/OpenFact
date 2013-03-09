<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sucursales extends CI_Controller {

	public function index()
	{
		$this->load->view('sucursales_view');
	}

	public function guarda(){
		$this->load->model('Sucursales_model');
		$this->Sucursales_model->nombre=$this->input->post('nombre');
		$this->Sucursales_model->domicilio=$this->input->post('domicilio'); 
		$this->Sucursales_model->guarda();
	}

	public function todos($pNombre=''){
		$this->load->model('Sucursales_model');
		$res=$this->Sucursales_model->todos($pNombre);
		echo json_encode($res->result());
	}

	public function sucursal($pId){
		$this->load->model('Sucursales_model');
		$this->Sucursales_model->id=$pId;
		$res=$this->Sucursales_model->obtiene();
		echo json_encode($res->result());
	}

	public function actualiza(){
		$this->load->model('Sucursales_model');
		$this->Sucursales_model->id=$this->input->post('id');
		$this->Sucursales_model->nombre=$this->input->post('nombre');
		$this->Sucursales_model->domicilio=$this->input->post('domicilio');
		$this->Sucursales_model->actualiza();
	}

}

