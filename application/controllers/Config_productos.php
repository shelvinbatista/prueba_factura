<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	Tipo: Controller
	Descripcion: Controlador que permite configurar las vistas relacionados con los productos. Se configuran abriendo la pagina donde el codigo esta guardado en un archivo layout_open, el layout_menu para mostrar el menu de la pagina, el body de la pagina a mostrar, y se cierra con layout_close donde estan relacionados los scripts.
*/
class Config_productos extends CI_Controller {
	/*
		Tipo: Vista
		Descripcion: Funcion para mostrar la vista de administrar productos
	*/
	public function admin_productos()
	{
		//Se valida la existencia de los datos del usuario que inicio sesion dentro de la session
		if($this->session->userdata('id_usuario_prueba') != null){
			$data = [
				"page" => "Productos"
			];
			$this->load->view('layout/layout_open');
			$this->load->view('layout/layout_menu', $data);
			
			//Se genera un array asociativo donde se pasan los modal a mostrar dentro de la pagina
			$data_body = [
				"modal_editar_producto" => $this->load->view('layout/modal/modal_editar_producto', "", true),
				"modal_crear_producto" => $this->load->view('layout/modal/modal_crear_producto', "", true)
			];

			$this->load->view('productos/admin', $data_body);
			$this->load->view('layout/layout_close');
		}else{
			header("Location:" . base_url());
		}
	}
}
