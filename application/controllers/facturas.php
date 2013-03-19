<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facturas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		 $this->load->view('facturas_view');
	}

	public function nuevaFactura(){

		$this->load->view('nuevaFactura_view.php');
	}


	public function creaFactura(){

		$this->load->model('Facturas_model');
		$this->load->model('ClienteDocumento_model');
		$this->load->model('DetalleDocumento_model');
		$this->load->model('Clientes');

		$this->Facturas_model->folio=$this->input->post('folio');
		$this->Facturas_model->cliente=$this->input->post('cliente');	
		$this->Facturas_model->fecha=$this->input->post('fecha');
		$this->Facturas_model->subtotal=$this->input->post('subtotal');
		$this->Facturas_model->importeIVA=$this->input->post('importeIVA');
		$this->Facturas_model->importeIEPS=$this->input->post('importeIEPS');
		$this->Facturas_model->importeRetIVA=$this->input->post('importeRetIVA');
		$this->Facturas_model->importeRetISR=$this->input->post('importeRetISR');
		$this->Facturas_model->total=$this->input->post('total');
		$this->Facturas_model->metodoPagocondicionesPago=$this->input->post('metodoPagocondicionesPago');
		$this->Facturas_model->condicionesPago=$this->input->post('condicionesPago');
		$this->Facturas_model->cuentaPago=$this->input->post('cuentaPago');
		$this->Facturas_model->lugarExpedicion=$this->input->post('lugarExpedicion');

		$id=$this->Facturas_model->guarda();

		$res=$this->Clientes->obtiene($this->input->post('cliente'));

		foreach ($res->result() as $row) {
			
			$this->ClienteDocumento_model->cliente=$row->id;
			$this->ClienteDocumento_model->razonSocial=$row->razonSocial;
			$this->ClienteDocumento_model->rfc=$row->rfc;
			$this->ClienteDocumento_model->calle=$row->calle;
			$this->ClienteDocumento_model->numInt=$row->numInt;
			$this->ClienteDocumento_model->numExt=$row->numExt;
			$this->ClienteDocumento_model->colonia=$row->colonia;
			$this->ClienteDocumento_model->cp=$row->cp;
			$this->ClienteDocumento_model->municipio=$row->municipio;
			$this->ClienteDocumento_model->estado=$row->estado;
			$this->ClienteDocumento_model->pais=$row->pais;

		}

		$this->ClienteDocumento_model->guarda();

		$partidas=json_decode($this->input->post('partidas'),true);
		$lim=sizeof($partidas)-1; 
		
		for ($i=0; $i <= $lim; $i++) { 
				
				$row=$partidas[$i];
				$this->DetalleDocumento_model->producto=$row[0];
				$this->DetalleDocumento_model->factura=$id;
				$this->DetalleDocumento_model->detalle=$row[1];
				$this->DetalleDocumento_model->precio=$row[2];
				$this->DetalleDocumento_model->cantidad=$row[3];
				$this->DetalleDocumento_model->total=$row[4];
				$this->DetalleDocumento_model->porcentajeIVA=$row[5];
				$this->DetalleDocumento_model->importeIVA=$row[6];
				$this->DetalleDocumento_model->porcentajeIEPS=$row[7];
				$this->DetalleDocumento_model->importeIEPS=$row[8];
				$this->DetalleDocumento_model->porcentajeRetIVA=$row[9];
				$this->DetalleDocumento_model->importeRetIVA=$row[10];
				$this->DetalleDocumento_model->porcentajeRetISR=$row[11];
				$this->DetalleDocumento_model->importeRetISR=$row[12];
				$this->DetalleDocumento_model->guarda();	

			}	
	}
}
