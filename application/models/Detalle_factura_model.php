<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
  Tipo: Modelo
  Descripcion: Modelo que permite configurar las consultas relacionados con el detalle de factura.
*/
class Detalle_factura_model extends CI_Model {

  /*
    Tipo: Funcion
    Descripcion: Funcion para guardar en la base de datos el detalle de una factura
  */
	public function insertar_detalle($datos)
  {
    $data = array(
      'id_factura' => $datos["factura"],
      'id_producto' => $datos["producto"],
      'cantidad' => $datos["cantidad"],
      'precio' => $datos["precio"],
      'total' => $datos["total"],
      'estado' => $datos["estado"]
    );
    
    $this->db->insert('detalle_factura', $data); 
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para obtener de la base de datos el detalle de una factura
  */
  public function get_detalle($id_factura)
  {
    $this->db->select("detalle_factura.*, productos.`nombre`, productos.`descripcion`, productos.`cantidad_stock`");
    $this->db->join('productos', 'productos.id = detalle_factura.id_producto', 'left');
    $this->db->where('detalle_factura.id_factura', $id_factura); 
    $this->db->order_by("productos.nombre", "asc");
    $query = $this->db->get('detalle_factura');
    return $query->result();
  }

}