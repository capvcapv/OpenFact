<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {

	
	public function index()
	{
		$this->load->view('productos_view');
	}

	public function guarda(){
		$this->load->model('Productos_model');
		$this->Productos_model->codigo=$this->input->post('codigo');
		$this->Productos_model->nombre=$this->input->post('nombre');
		$this->Productos_model->descripcion=$this->input->post('descripcion');
		$this->Productos_model->precio1=$this->input->post('precio1');
		$this->Productos_model->precio2=$this->input->post('precio2');
		$this->Productos_model->unidad=$this->input->post('unidad');
		$this->Productos_model->exento=$this->input->post('exento');
		$this->Productos_model->porcentajeIVA=$this->input->post('porcentajeIVA');
		$this->Productos_model->porcentajeIEPS=$this->input->post('porcentajeIEPS');
		$this->Productos_model->porcentajeRetIVA=$this->input->post('porcentajeRetIVA');
		$this->Productos_model->porcentajeRetISR=$this->input->post('porcentajeRetISR');
		$this->Productos_model->guarda();
	}

	public function todos($pNombre=''){
		$this->load->model('Productos_model');
		$res=$this->Productos_model->todos($pNombre);
		echo json_encode($res->result());
	}

	public function producto($pCodigo){
		$this->load->model('Productos_model');
		$res=$this->Productos_model->busca($pCodigo);
		echo json_encode($res->result());
	}

	public function actualiza(){
		$this->load->model('Productos_model');
		$this->Productos_model->codigo=$this->input->post('codigo');
		$this->Productos_model->nombre=$this->input->post('nombre');
		$this->Productos_model->descripcion=$this->input->post('descripcion');
		$this->Productos_model->precio1=$this->input->post('precio1');
		$this->Productos_model->precio2=$this->input->post('precio2');
		$this->Productos_model->unidad=$this->input->post('unidad');
		$this->Productos_model->porcentajeIVA=$this->input->post('porcentajeIVA');
		$this->Productos_model->porcentajeIEPS=$this->input->post('porcentajeIEPS');
		$this->Productos_model->porcentajeRetIVA=$this->input->post('porcentajeRetIVA');
		$this->Productos_model->porcentajeRetISR=$this->input->post('porcentajeRetISR');
		$this->Productos_model->actualiza($this->input->post('id'));
	}
}
