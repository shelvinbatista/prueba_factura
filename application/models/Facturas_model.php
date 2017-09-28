<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /*
    Tipo: Modelo
    Descripcion: Modelo que permite configurar las consultas relacionados con la factura.
  */
class Facturas_model extends CI_Model {

  /*
    Tipo: Funcion
    Descripcion: Funcion para guardar en la base de datos una nueva factura
  */
	public function insertar_factura($datos)
  {
    $data = array(
      'id_cliente' => $datos["id_cliente"],
      'total' => $datos["total"],
      'estado' => $datos["estado"]
    );
    $this->db->set('fecha', 'CURDATE()', FALSE);
    $this->db->set('hora', 'curTime()', FALSE);

    $this->db->insert('factura', $data);

    $this->db->select("MAX(id) AS id");
    $query = $this->db->get('factura');
    return $query->result()[0]->id; 
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para modificar en la base de datos los datos de una factura
  */
  public function modificar_factura($datos)
  {
    $data = array(
      'estado' => $datos["estado"]
    );
    $this->db->where('id', $datos["factura"]); 
    $this->db->update('factura', $data);
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para obtener los datos de una factura
  */
  public function get_factura($id_factura)
  {
    $this->db->select("factura.*, usuarios.`tipo_usuario`, usuarios.`nombres`, usuarios.`apellidos`, usuarios.`tipo_documento`, usuarios.`numero_documento`, usuarios.`email`, usuarios.`direccion`, usuarios.`telefono`");
    $this->db->join('usuarios', 'usuarios.id = factura.id_cliente', 'left');
    $this->db->where('factura.id', $id_factura); 
    $query = $this->db->get('factura');
    return $query->result();
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para listar las facturas
  */
  public function listar_facturas($id_cliente)
  {
    $this->db->select("*");
    $this->db->where('id_cliente', $id_cliente); 
    $this->db->order_by('fecha asc, hora asc'); 
    $query = $this->db->get('factura');
    return $query->result();
  }

}