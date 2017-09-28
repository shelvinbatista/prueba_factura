<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
  Tipo: Modelo
  Descripcion: Modelo que permite configurar las consultas relacionados con los pagos o abonos a facturas.
*/
class Pagos_model extends CI_Model {
	
  /*
    Tipo: Funcion
    Descripcion: Funcion para guardar en la base de datos los abonos de facturas
  */
  public function insertar_pago($datos)
  {
    $data = array(
      'id_factura' => $datos["factura"],
      'valor_abono' => $datos["abono"]
    );
    $this->db->set('fecha', 'CURDATE()', FALSE);
    $this->db->set('hora', 'curTime()', FALSE);
    
    $this->db->insert('pagos', $data); 
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para obtener los datos de los abonos realizados a una factura
  */
  public function get_pagos($id_factura)
  {
    $this->db->select("*");
    $this->db->where('id_factura', $id_factura); 
    $this->db->order_by('fecha asc, hora asc'); 
    $query = $this->db->get('pagos');
    return $query->result();
  }

}