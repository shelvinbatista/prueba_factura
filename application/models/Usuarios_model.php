<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
  Tipo: Modelo
  Descripcion: Modelo que permite configurar las consultas relacionados con los usuarios.
*/
class Usuarios_model extends CI_Model {

  /*
    Tipo: Funcion
    Descripcion: Funcion para guardar en la base de datos los usuarios
  */
  public function insertar_usuario($datos)
  {
    $data = array(
      'tipo_usuario' => $datos["tipo_usuario"],
      'nombres' => $datos["nombres"],
      'apellidos' => $datos["apellidos"],
      'tipo_documento' => $datos["tipo_documento"],
      'numero_documento' => $datos["numero_documento"],
      'email' => $datos["email"],
      'clave' => $datos["clave"],
      'direccion' => $datos["direccion"],
      'telefono' => $datos["telefono"]
    );
    $this->db->insert('usuarios', $data);
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para modificar en la base de datos los usuarios
  */
  public function modificar_usuario($datos)
  {
    $data = array(
      'tipo_usuario' => $datos["tipo_usuario"],
      'nombres' => $datos["nombres"],
      'apellidos' => $datos["apellidos"],
      'tipo_documento' => $datos["tipo_documento"],
      'numero_documento' => $datos["numero_documento"],
      'email' => $datos["email"],
      'clave' => $datos["clave"],
      'direccion' => $datos["direccion"],
      'telefono' => $datos["telefono"]
    );
    $this->db->where('id', $datos["id_usuario"]); 
    $this->db->update('usuarios', $data);
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para consultar por email y clave los datos de un usuario
  */
	public function usuario_login($usuario, $clave)
  {
  	$this->db->select("*");
  	$this->db->where('email', $usuario); 
  	$this->db->where('clave', $clave); 
    $query = $this->db->get('usuarios');
    return $query->result();
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para consultar el numero de documento los datos de un usuario
  */
  public function get_usuario_documento($documento, $tipo)
  {
    $this->db->select("*");
    $this->db->where('numero_documento', $documento); 
    $this->db->where('tipo_usuario', $tipo); 
    $query = $this->db->get('usuarios');
    return $query->result();
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para consultar el numero de documento los datos de un usuario
  */
  public function get_usuario_documento_insertar($documento)
  {
    $this->db->select("*");
    $this->db->where('numero_documento', $documento); 
    $query = $this->db->get('usuarios');
    return $query->result();
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para consultar el email los datos de un usuario
  */
  public function get_usuario_email($email)
  {
    $this->db->select("*");
    $this->db->where('email', $email); 
    $query = $this->db->get('usuarios');
    return $query->result();
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para consultar el id los datos de un usuario
  */
  public function get_usuario($id_usuario)
  {
    $this->db->select("*");
    $this->db->where('id', $id_usuario); 
    $query = $this->db->get('usuarios');
    return $query->result();
  }

  /*
    Tipo: Funcion
    Descripcion: Funcion para listar todos los usuarios registrados en la base de datos
  */
  public function listar_usuarios()
  {
    $this->db->select("*");
    $this->db->order_by('nombres asc, apellidos asc'); 
    $query = $this->db->get('usuarios');
    return $query->result();
  }

}