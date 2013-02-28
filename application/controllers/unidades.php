 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unidades extends CI_Controller {

	
	public function index()
	{
		$this->load->view('unidades_view');
	}

	public function guarda($pNombre){
		$this->load->model('Unidades_model');
		$this->Unidades_model->nombre=$pNombre;
		$this->Unidades_model->guarda();	
	}

	public function todos(){
		$this->load->model('Unidades_model');
		$res=$this->Unidades_model->todos();
		echo json_encode($res->result());
	}

	public function unidad($pId){
		$this->load->model('Unidades_model');
		$res=$this->Unidades_model->obtiene($pId);
		echo json_encode($res->result());
	}

	public function actualiza($pId,$pNombre){
		$this->load->model('Unidades_model');
		$this->Unidades_model->nombre=$pNombre;
		$this->Unidades_model->actualiza($pId);
	}
}
