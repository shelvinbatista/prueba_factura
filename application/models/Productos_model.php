<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
  Tipo: Modelo
  Descripcion: Modelo que permite configurar las consultas relacionados con los productos
*/
class Productos_model extends CI_Model {

  /*
    Tipo: Funcion
    Descripcion: Funcion para listar los productos con filtro de datos enviados como paramtro a la funcion
  */
	public function listar_productos($validacion)
  {
    $this->db->select("*");
  	$this->db->order_by("nombre", "asc");
    if($validacion == "Factura"){
      $this->db->where('cantidad_stock > 0'); 
    }
  	$query = $this->db->get('productos');
  	return $query->result();
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para obtener los datos de un producto
  */
  public function get_producto($id_producto)
	{
  	$this->db->select("*");
  	$this->db->where('id', $id_producto); 
    $query = $this->db->get('productos');
    return $query->result();
	}

  /*
    Tipo: Funcion
    Descripcion: Funcion para modificar la cantidad en el stock de un producto
  */
  public function modificar_producto($datos)
  {
    $data = array(
      'cantidad_stock' => $datos["cantidad"]
    );
    $this->db->where('id', $datos["producto"]); 
    $this->db->update('productos', $data);
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para modificar los datos de un producto
  */
  public function modificar_datos_producto($datos)
  {
    $data = array(
      'nombre' => $datos["nombre"],
      'descripcion' => $datos["descripcion"],
      'precio' => $datos["precio"],
      'cantidad_stock' => $datos["cantidad_stock"]
    );
    $this->db->where('id', $datos["id_producto"]); 
    $this->db->update('productos', $data);
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para crear un producto
  */
  public function insertar_producto($datos)
  {
    $data = array(
      'nombre' => $datos["nombre"],
      'descripcion' => $datos["descripcion"],
      'precio' => $datos["precio"],
      'cantidad_stock' => $datos["cantidad_stock"]
    );
    $this->db->insert('productos', $data);
  }

}