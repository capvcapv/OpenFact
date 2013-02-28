<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DetalleDocumento extends CI_Model {

	var $id;
	var $producto;
	var $factura;
	var $detalle;
	var $precio;
	var $cantidad;
	var $total;
	var $porcentajeIVA;
	var $importeIVA;
	var $porcentajeIEPS;
	var $importeIEPS;
	var $porcentajeRetIVA;
	var $importeRetIVA;
	var $porcentajeRetIRS;
	var $importeRetISR;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function obtenerDetalles(){

		$this->db->select('Productos.nombre,factura,detalle,precio,cantidad,porcentajeIVA,importeIVA,porcentajeIEPS,importeIEPS,porcentajeRetIVA,importeRetIVA,porcentajeRetISR,importeRetISR');
		$this->db->from('DetalleFactura_model');
		$this->db->join('Productos', 'DetalleFactura_model.producto = Productos.id', 'inner');
		return $this->db->get();
	}

	public function guarda(){

		$this->db->set('producto',$this->producto);
		$this->db->set('factura',$this->factura);
		$this->db->set('detalle',$this->detalle);
		$this->db->set('precio',$this->precio);
		$this->db->set('cantidad',$this->cantidad);
		$this->db->set('total',$this->total);
		$this->db->set('porcentajeIVA',$this->porcentajeIVA);
		$this->db->set('importeIVA',$this->importeIVA);
		$this->db->set('porcentajeIEPS',$this->porcentajeIEPS);
		$this->db->set('importeIEPS',$this->importeIEPS);
		$this->db->set('porcentajeRetIVA',$this->porcentajeRetIVA);
		$this->db->set('importeRetIVA',$this->importeRetIVA);
		$this->db->set('porcentajeRetISR',$this->porcentajeRetISR);
		$this->db->set('importeRetISR',$this->importeRetISR);

		$this->db->insert('DetalleFactura_model');
	}

}

/* End of file detalleFactura_model.php */
/* Location: ./application/models/detalleFactura_model.php */