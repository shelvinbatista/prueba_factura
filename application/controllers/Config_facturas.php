<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	Tipo: Controller
	Descripcion: Controlador que permite configurar las vistas relacionados con las facturas. Se configuran abriendo la pagina donde el codigo esta guardado en un archivo layout_open, el layout_menu para mostrar el menu de la pagina, el body de la pagina a mostrar, y se cierra con layout_close donde estan relacionados los scripts.
*/
class Config_facturas extends CI_Controller {
	/*
		Tipo: Vista
		Descripcion: Funcion para mostrar la vista de generar una factura
	*/
	public function realizar_factura()
	{
		//Se valida la existencia de los datos del usuario que inicio sesion dentro de la session
		if($this->session->userdata('id_usuario_prueba') != null){
			$data = [
				"page" => "Facturas"
			];
			$this->load->view('layout/layout_open');
			$this->load->view('layout/layout_menu', $data);
			$this->load->view('facturas/generar_factura');
			$this->load->view('layout/layout_close');
		}else{
			header("Location:" . base_url());
		}
		
	}

	/*
		Tipo: Vista
		Descripcion: Funcion para mostrar la vista de generar abonos a facturas
	*/
	public function realizar_abonos()
	{
		//Se valida la existencia de los datos del usuario que inicio sesion dentro de la session
		if($this->session->userdata('id_usuario_prueba') != null){
			$data = [
				"page" => "Facturas"
			];
			$this->load->view('layout/layout_open');
			$this->load->view('layout/layout_menu', $data);
			
			//Se genera un array asociativo donde se pasan los modal a mostrar dentro de la pagina
			$data_body = [
				"modal_abono" => $this->load->view('layout/modal/modal_abonar_factura', "", true),
				"modal_productos" => $this->load->view('layout/modal/modal_ver_productos', "", true)
			];
			$this->load->view('facturas/generar_abonos', $data_body);
			$this->load->view('layout/layout_close');
		}else{
			header("Location:" . base_url());
		}
		
	}
}
