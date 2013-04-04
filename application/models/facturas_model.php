<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facturas_model extends CI_Model {

	var $id;
	var $folio;
	var $cliente;
	var $fecha;
	var $metodoPago;
	var $condicionesPago;
	var $cuentaPago;
	var $lugarExpedicion;
	var $estatus;

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
		$this->db->set('metodoPago',$this->metodoPago);
		$this->db->set('condicionesPago',$this->condicionesPago);
		$this->db->set('cuentaPago',$this->cuentaPago);
		$this->db->set('lugarExpedicion',$this->lugarExpedicion);
		$this->db->set('estatus',0);
	
		$this->db->insert('Facturas');

	}

	public function actualiza(){

		$this->db->where('id', $this->id);
		$this->db->update('Facturas', $this);
	}

}
