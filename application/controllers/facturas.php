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

	public function todos(){

		$this->load->model('Facturas_model');
		$res=$this->Facturas_model->todos();

		echo json_encode($res->result());
	}

	public function nuevaFactura(){
		$this->load->view('nuevaFactura_view');
	}

	/**
	 Funcion que inicializa la factura en base a los parametros 
	 si no se le dan los parametros este inicializa una nueva factura 
	 el argumento debe ser la serie y folio del documento en caso de 
	 retomar algun documento. 
	**/

	public function inicializaFactura($serie='',$folio=0){

		$this->load->model('Folios_model');
		$this->load->model('Facturas_model');

		if($serie=='' && $folio==0){

			$folios=$this->Folios_model->foliosDisponibles();
			$a=$folios->result();
			
			echo json_encode($a[0]);

			$this->Folios_model->id=$a[0]->id;
			$this->Folios_model->serie=$a[0]->serie;
			$this->Folios_model->folio=$a[0]->folio;
			$this->Folios_model->blockfolios=$a[0]->blockfolios;
			$this->Folios_model->ocupado=1;	

			//$this->Folios_model->actualiza();	

			$this->Facturas_model->folio=$a[0]->id;
			$this->Facturas_model->estatus=0;	
			//$this->Facturas_model->guarda();
		
		}else{

			$folios=$this->Folios_model->obtener($serie,$folio);
			$a=$folios->result();

			$arreglo=array();
			$arreglo[0]=$a;

			$factura=$this->Facturas_model->obtiene($a[0]->id);
			$b=$factura->result();

			$arreglo[1]=$b;

			echo json_encode($arreglo);

		}

			
	}
	/**
		Funcion que guarda en base a dos JSON enviados por el metodo POST
		los datos de un documento el documento ya debe ser creado por el 
		metodo inicializaFactura este metodo lo unico que hace es actualizar
		la informacion de la factura.
	**/
	public function guardaFactura(){

		
	}

	public function terminaFactura(){


	}

	public function entregaFactura(){


	}

	public function datosGenerales(){

		$this->load->model('Condicionespago_model');
		$this->load->model('MetodosPago_model');

		$res=$this->Condicionespago_model->todos();
		$res1=$this->MetodosPago_model->todos();

		$array=[$res->result(),$res1->result()];

		echo json_encode($array);
	
	}

	public function iva($idProducto,$idCliente){

		$this->load->model('Productos_model');
		$this->load->model('Clientes_model');
		$this->load->model('Empresa_model');

		$res=$this->Productos_model->busca($idProducto);
		$producto=$res->result();

		if($producto[0]->exento==1){
			echo "0";
		}else{

			if($producto[0]->porcentajeIVA>1){
				echo $producto[0]->porcentajeIVA;
			}else{
				$res=$this->Clientes_model->busca($idCliente);
				$cliente=$res->result();

				if($cliente[0]->porcentajeIVA>1){
					echo $cliente[0]->porcentajeIVA;
				}else{
					$this->Empresa_model->id=1;
					$res=$this->Empresa_model->obtiene();
					$empresa=$res->result();

					echo $empresa[0]->porcentajeIVA;
				}
			}
		}


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
