<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Folios extends CI_Controller {

	
	public function index(){

		$this->load->view('folios_view');

	}

	public function guarda(){

		$this->load->model('Blockfolio_model');
		$this->Blockfolio_model->serie=$this->input->post('serie');
		$this->Blockfolio_model->folioInicial=$this->input->post('folioInicial');
		$this->Blockfolio_model->folioFinal=$this->input->post('folioFinal');
		$this->Blockfolio_model->aprobacion=$this->input->post('aprobacion');
		$this->Blockfolio_model->inicioVigencia=$this->input->post('inicioVigencia');
		$this->Blockfolio_model->finVigencia=$this->input->post('finVigencia');
		$this->Blockfolio_model->cbb=$this->input->post('cbb');

		$id=$this->Blockfolio_model->guarda();

		$folioInicial=(int)$this->input->post('folioInicial');
		$folioFinal=(int)$this->input->post('folioFinal');

		for ($i=$folioInicial; $i<=$folioFinal ; $i++) { 
			$this->load->model('Folios_model');
			$this->Folios_model->serie=$this->input->post('serie');
			$this->Folios_model->folio=$i;
			$this->Folios_model->blockfolios=$id;
			$this->Folios_model->ocupado=0;
			$this->Folios_model->guarda();
		}

		if(!file_exists('/home/carlos/cbb/')){
			mkdir('/home/carlos/cbb/');
		}

		rename('/var/www/OpenFact/cbb/'.$this->input->post('cbb'),'carpeta temporal'.$this->input->post('cbb'));
						
	}

	public function subirCBB(){
		
		$config['upload_path'] = './cbb/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
		
			//echo $this->upload->display_errors();
			echo "Error.png";
		}
		else
		{
			$data = $this->upload->data();

			echo $data['orig_name'];
		}
	}

	public function infoFolios(){

		$this->load->model('Folios_model');
		$res=$this->Folios_model->foliosDisponibles();
		
		echo $res->num_rows();
	}

	public function foliosDisponibles(){
		$this->load->model('Blockfolio_model');
		$res=$this->Blockfolio_model->obtenerTodos();
		echo json_encode($res->result());
	}
}
