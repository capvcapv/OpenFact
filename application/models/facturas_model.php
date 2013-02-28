<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facturas_model extends CI_Model {

	var $id;
	var $folio;
	var $cliente;
	var $fecha;
	var $subtotal;
	var $importeIVA;
	var $importeIEPS;
	var $importeRetIVA;
	var $importeRetIEPS;
	var $total;
	var $metodoPago;
	var $condicionesPago;
	var $cuentaPago;
	var $lugarExpedicion;

	public function __construct() {
		parent::__construct();
	}

	public function todos(){

		$this->db->select('ClienteDocumento.rfc,Folios.serie,Folios.folio');
		$this->db->from('Facturas');
		$this->db->join('ClienteDocumento', 'Facturas.cliente = ClienteDocumento.id', 'inner');
		$this->db->join('Folios', 'Facturas.folio = Folios.id', 'inner');
		return $this->db->get();

	}

	public function obtiene(){

		/**$this->db->select('ClienteDocumento.rfc,Folios.serie,Folios.folio');
		$this->db->from('Facturas');
		$this->db->join('ClienteDocumento', 'Facturas.cliente = ClienteDocumento.id', 'inner');
		$this->db->join('Folios', 'Facturas.folio = Folios.id', 'inner');
		$this->db->where('Field / comparison', $Value);
		return $this->db->get('Facturas');**/

	}

	public function guarda(){

		$this->db->set('folio',$this->folio);
		$this->db->set('cliente',$this->cliente);
		$this->db->set('fecha',$this->fecha);
		$this->db->set('subtotal',$this->subtotal);
		$this->db->set('importeIVA',$this->importeIVA);
		$this->db->set('importeIEPS',$this->importeIEPS);
		$this->db->set('importeRetIVA',$this->importeRetIVA);
		$this->db->set('importeRetISR',$this->importeRetISR);
		$this->db->set('total',$this->total);
		$this->db->set('metodoPago',$this->metodoPago);
		$this->db->set('condicionesPago',$this->condicionesPago);
		$this->db->set('cuentaPago',$this->cuentaPago);
		$this->db->set('lugarExpedicion',$this->lugarExpedicion);
	
		$this->db->insert('Facturas');

	}

}

/* End of file facturas_model.php */
/* Location: ./application/models/facturas_model.php */
