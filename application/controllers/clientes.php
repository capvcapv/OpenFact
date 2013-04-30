<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {

	
	public function index()
	{
		$this->load->view('clientes_view');
	}

	public function guarda(){
		$this->load->model('Clientes_model');
		$this->Clientes_model->razonSocial=$this->input->post('razonSocial');
		$this->Clientes_model->rfc=$this->input->post('rfc');
		$this->Clientes_model->calle=$this->input->post('calle');
		$this->Clientes_model->numInt=$this->input->post('numInt');
		$this->Clientes_model->numExt=$this->input->post('numExt');
		$this->Clientes_model->colonia=$this->input->post('colonia');
		$this->Clientes_model->cp=$this->input->post('cp');
		$this->Clientes_model->municipio=$this->input->post('municipio');
		$this->Clientes_model->estado=$this->input->post('estado');
		$this->Clientes_model->pais=$this->input->post('pais');
		$this->Clientes_model->correoElectronico=$this->input->post('correoElectronico');
		$this->Clientes_model->telefono=$this->input->post('telefono');
		$this->Clientes_model->porcentajeIVA=$this->input->post('porcentajeIVA');
		$this->Clientes_model->porcentajeIEPS=$this->input->post('porcentajeIEPS');
		$this->Clientes_model->porcentajeRetIVA=$this->input->post('porcentajeRetIVA');
		$this->Clientes_model->porcentajeRetISR=$this->input->post('porcentajeRetISR');
		$this->Clientes_model->guarda();
	}

	public function todos($razon=''){
		$this->load->model('Clientes_model');
		$res=$this->Clientes_model->todos($razon);
		echo json_encode($res->result());
	}

	public function cliente($pId){
		$this->load->model('Clientes_model');
		$res=$this->Clientes_model->busca($pId);
		echo json_encode($res->result());
	}

	public function actualiza(){
		$this->load->model('Clientes_model');
		$this->Clientes_model->razonSocial=$this->input->post('razonSocial');
		$this->Clientes_model->rfc=$this->input->post('rfc');
		$this->Clientes_model->calle=$this->input->post('calle');
		$this->Clientes_model->numInt=$this->input->post('numInt');
		$this->Clientes_model->numExt=$this->input->post('numExt');
		$this->Clientes_model->colonia=$this->input->post('colonia');
		$this->Clientes_model->cp=$this->input->post('cp');
		$this->Clientes_model->municipio=$this->input->post('municipio');
		$this->Clientes_model->estado=$this->input->post('estado');
		$this->Clientes_model->pais=$this->input->post('pais');
		$this->Clientes_model->correoElectronico=$this->input->post('correoElectronico');
		$this->Clientes_model->telefono=$this->input->post('telefono');
		$this->Clientes_model->porcentajeIVA=$this->input->post('porcentajeIVA');
		$this->Clientes_model->porcentajeIEPS=$this->input->post('porcentajeIEPS');
		$this->Clientes_model->porcentajeRetIVA=$this->input->post('porcentajeRetIVA');
		$this->Clientes_model->porcentajeRetISR=$this->input->post('porcentajeRetISR');
		$this->Clientes_model->actualiza($this->input->post('id'));
	}
}
