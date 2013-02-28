<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empresas extends CI_Controller {

	
	public function index()
	{
		$this->load->view('empresas_view');
	}

	public function guarda(){
		$this->load->model('Empresa_model');
		$this->Empresa_model->nombre=$this->input->post('nombre');
		$this->Empresa_model->rfc=$this->input->post('rfc');
		$this->Empresa_model->calle=$this->input->post('calle');
		$this->Empresa_model->numInt=$this->input->post('numInt');
		$this->Empresa_model->numExt=$this->input->post('numExt');
		$this->Empresa_model->colonia=$this->input->post('colonia');
		$this->Empresa_model->cp=$this->input->post('cp');
		$this->Empresa_model->municipio=$this->input->post('municipio');
		$this->Empresa_model->estado=$this->input->post('estado');
		$this->Empresa_model->pais=$this->input->post('pais');
		$this->Empresa_model->regimenFiscal=$this->input->post('regimenFiscal');
		$this->Empresa_model->porcentajeIVA=$this->input->post('porcentajeIVA');
		$this->Empresa_model->porcentajeIEPS=$this->input->post('porcentajeIEPS');
		$this->Empresa_model->porcentajeRetIVA=$this->input->post('porcentajeRetIVA');
		$this->Empresa_model->porcentajeRetISR=$this->input->post('porcentajeRetISR');
		$this->Empresa_model->guarda();	
	}

	public function busca(){
		$this->load->model('Empresa_model');
		$res=$this->Empresa_model->todos();
		echo json_encode($res->result());
	}

	public function actualiza(){
		$this->load->model('Empresa_model');
		$this->Empresa_model->nombre=$this->input->post('nombre');
		$this->Empresa_model->rfc=$this->input->post('rfc');
		$this->Empresa_model->calle=$this->input->post('calle');
		$this->Empresa_model->numInt=$this->input->post('numInt');
		$this->Empresa_model->numExt=$this->input->post('numExt');
		$this->Empresa_model->colonia=$this->input->post('colonia');
		$this->Empresa_model->cp=$this->input->post('cp');
		$this->Empresa_model->municipio=$this->input->post('municipio');
		$this->Empresa_model->estado=$this->input->post('estado');
		$this->Empresa_model->pais=$this->input->post('pais');
		$this->Empresa_model->regimenFiscal=$this->input->post('regimenFiscal');
		$this->Empresa_model->porcentajeIVA=$this->input->post('porcentajeIVA');
		$this->Empresa_model->porcentajeIEPS=$this->input->post('porcentajeIEPS');
		$this->Empresa_model->porcentajeRetIVA=$this->input->post('porcentajeRetIVA');
		$this->Empresa_model->porcentajeRetISR=$this->input->post('porcentajeRetISR');
		$this->Empresa_model->actualiza('1');
	}
}
