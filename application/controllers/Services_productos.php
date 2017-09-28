<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_productos extends CI_Controller {
	/*
		Tipo: Servicio
		Descripcion: Funcion para listar todos los productos, dependiendo de filtro, Todos (Se listan todos los productos o se listan los productos que tengan cantidad suficiente para agregarse en una factura)
	*/
	public function api_listar_productos()
	{
		$this->load->model("productos_model");

		$post = $this->input->post();
		$data = $this->productos_model->listar_productos($post["filtro"]);
		echo json_encode($data);
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para obtener los datos de un producto que selecciona el usuario en la pagina desde el administrador de productos
	*/
	public function api_obtener_producto()
	{
		$this->load->model("productos_model");

		$post = $this->input->post();
		$data = $this->productos_model->get_producto($post["id_producto"]);
		echo json_encode($data[0]);
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para crear un producto en la base de datos
	*/
	public function api_crear_producto()
	{
		$this->load->model("productos_model");

		$post = $this->input->post();
		$data = $this->productos_model->insertar_producto($post);
		
		$array_response = array('tipo' => "OK", "Mensaje" => "¡Producto creado con éxito!");
		echo json_encode($array_response);
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para modificar los datos de un producto en la base de datos
	*/
	public function api_modificar_producto()
	{
		$this->load->model("productos_model");

		$post = $this->input->post();
		$data = $this->productos_model->modificar_datos_producto($post);
		
		$array_response = array('tipo' => "OK", "Mensaje" => "¡Producto modificado con éxito!");
		echo json_encode($array_response);
	}

}
	