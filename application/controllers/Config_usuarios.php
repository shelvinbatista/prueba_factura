<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	Tipo: Controller
	Descripcion: Controlador que permite configurar las vistas relacionados con los usuario. Se configuran abriendo la pagina donde el codigo esta guardado en un archivo layout_open, el layout_menu para mostrar el menu de la pagina, el body de la pagina a mostrar, y se cierra con layout_close donde estan relacionados los scripts.
*/
class Config_usuarios extends CI_Controller {
	/*
		Tipo: Vista
		Descripcion: Funcion para mostrar la vista de la pagina iniciar sesion
	*/
	public function login()
	{
		$this->load->view('layout/layout_open');
		$this->load->view('login');
		$this->load->view('layout/layout_close');
	}

	/*
		Tipo: Vista
		Descripcion: Funcion para mostrar la vista home despues de que un usuario inicia sesion
	*/
	public function home()
	{
		//Se valida la existencia de los datos del usuario que inicio sesion dentro de la session
		if($this->session->userdata('id_usuario_prueba') != null){
			$data = [
				"page" => "Home"
			];
			$this->load->view('layout/layout_open');
			$this->load->view('layout/layout_menu', $data);
			$this->load->view('home');
			$this->load->view('layout/layout_close');
		}else{
			header("Location:" . base_url());
		}
	}

	/*
		Tipo: Vista
		Descripcion: Funcion para mostrar la vista de administrar usuarios
	*/
	public function admin_usuarios()
	{
		//Se valida la existencia de los datos del usuario que inicio sesion dentro de la session
		if($this->session->userdata('id_usuario_prueba') != null){
			$data = [
				"page" => "Usuarios"
			];
			$this->load->view('layout/layout_open');
			$this->load->view('layout/layout_menu', $data);
			
			//Se genera un array asociativo donde se pasan los modal a mostrar dentro de la pagina
			$data_body = [
				"modal_editar_usuario" => $this->load->view('layout/modal/modal_editar_usuario', "", true),
				"modal_crear_usuario" => $this->load->view('layout/modal/modal_crear_usuario', "", true)
			];

			$this->load->view('usuarios/admin', $data_body);
			$this->load->view('layout/layout_close');
		}else{
			header("Location:" . base_url());
		}
	}

	/*
		Tipo: Vista
		Descripcion: Funcion para mostrar la vista de editar datos del usuario que inicia sesion
	*/
	public function editar_perfil()
	{
		//Se valida la existencia de los datos del usuario que inicio sesion dentro de la session
		if($this->session->userdata('id_usuario_prueba') != null){
			$data = [
				"page" => "Perfil"
			];
			$this->load->view('layout/layout_open');
			$this->load->view('layout/layout_menu', $data);
			$this->load->view('usuarios/editar_perfil');
			$this->load->view('layout/layout_close');
		}else{
			header("Location:" . base_url());
		}
	}
}
	