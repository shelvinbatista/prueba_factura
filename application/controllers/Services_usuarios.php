<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_usuarios extends CI_Controller {
	/*
		Tipo: Servicio
		Descripcion: Funcion para iniciar sesion con los datos que ingresa el usuario, si el usuario existe se guardan datos importantes en la session para validarse cada vez que se abra una pagina debido al tiempo limite de inactividad
	*/
	public function api_iniciar_sesion()
	{
		$this->load->model("usuarios_model");

		$post = $this->input->post();
		$post["clave"] = base64_encode($post["clave"]);
		$data = $this->usuarios_model->usuario_login($post["email"], $post["clave"]);

		if(count($data) == 1){
			$data = $data[0];
		}

		$data_session = [
            'id_usuario_prueba' => $data->id,
            'tipo_usuario_prueba' => $data->tipo_usuario
        ];
        $this->session->set_userdata($data_session);	
		echo json_encode($data);
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para buscar un usuario por su numero de documento y su tipo de usuario en el sistema
	*/
	public function api_buscar_documento()
	{
		$this->load->model("usuarios_model");

		$post = $this->input->post();
		$data = $this->usuarios_model->get_usuario_documento($post["documento_buscar"], $post["tipo"]);
		if(count($data) > 0){
			echo json_encode($data[0]);
		}else{
			echo "{}";
		}
		
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para listar todos los usuario registrados en la base de datos
	*/
	public function api_listar_usuarios()
	{
		$this->load->model("usuarios_model");

		$post = $this->input->post();

		$data = $this->usuarios_model->listar_usuarios();
		echo json_encode($data);
		
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para obtener los datos de un usuario en la base de datos
	*/
	public function api_obtener_usuario()
	{
		$this->load->model("usuarios_model");

		$post = $this->input->post();

		$data = $this->usuarios_model->get_usuario($post["id_usuario"]);
		if(count($data) > 0){
			$data = $data[0];
			$data->clave = base64_decode($data->clave);
			echo json_encode($data);
		}else{
			echo "{}";
		}
		
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para obtener los datos del usuario que inicio sesion en la base de datos
	*/
	public function api_obtener_usuario_session()
	{
		$this->load->model("usuarios_model");

		$post = $this->input->post();
		$id_usuario = $this->session->userdata('id_usuario_prueba');

		$data = $this->usuarios_model->get_usuario($id_usuario);
		if(count($data) > 0){
			$data = $data[0];
			$data->clave = base64_decode($data->clave);
			echo json_encode($data);
		}else{
			echo "{}";
		}
		
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para modificar los datos un usuario en la base de datos
	*/
	public function api_modificar_usuario()
	{
		$this->load->model("usuarios_model");

		$post = $this->input->post();
		$post["clave"] = base64_encode($post["clave"]);

		$data_usuario = $this->usuarios_model->get_usuario_email($post["email"]);

		$data_usuario_documento = $this->usuarios_model->get_usuario_documento_insertar($post["numero_documento"]);

		if(($post["email_original"] == $post["email"]) || ($post["numero_documento_original"] == $post["numero_documento"])){

			if(($post["email_original"] != $post["email"]) && ($post["numero_documento_original"] == $post["numero_documento"])){
				if(count($data_usuario) == 0){
					$data = $this->usuarios_model->modificar_usuario($post);
					$array_response = array('tipo' => "OK", "Mensaje" => "¡Usuario modificado con éxito!");
					echo json_encode($array_response);
				}else{
					$mensaje = "";
					$mensaje .= "¡El email " . $post["email"] . " ya se encuentra registrado, ingrese otro!";
					$array_response = array('tipo' => "ERROR", "Mensaje" => $mensaje);
					echo json_encode($array_response);		
				}
			}
			if(($post["email_original"] == $post["email"]) && ($post["numero_documento_original"] != $post["numero_documento"])){
				if(count($data_usuario_documento) == 0){
					$data = $this->usuarios_model->modificar_usuario($post);
					$array_response = array('tipo' => "OK", "Mensaje" => "¡Usuario modificado con éxito!");
					echo json_encode($array_response);
				}else{
					$mensaje = "";
					$mensaje .= "¡El Numero de Documento " . $post["numero_documento"] . " ya se encuentra registrado, ingrese otro!";
					$array_response = array('tipo' => "ERROR", "Mensaje" => $mensaje);
					echo json_encode($array_response);		
				}
			}
			if(($post["email_original"] == $post["email"]) && ($post["numero_documento_original"] == $post["numero_documento"])){
				
				$data = $this->usuarios_model->modificar_usuario($post);
				$array_response = array('tipo' => "OK", "Mensaje" => "¡Usuario modificado con éxito!");
				echo json_encode($array_response);
			}
		}else{

			if(count($data_usuario) == 0 && count($data_usuario_documento) == 0){
				$data = $this->usuarios_model->modificar_usuario($post);
				$array_response = array('tipo' => "OK", "Mensaje" => "¡Usuario modificado con éxito!");
				echo json_encode($array_response);
			}else{
				$mensaje = "";
				if(count($data_usuario) > 0){
					$mensaje .= "¡El email " . $post["email"] . " ya se encuentra registrado, ingrese otro!";
				}
				if(count($data_usuario_documento) > 0){
					$mensaje .= " ¡El Numero de Documento " . $post["numero_documento"] . " ya se encuentra registrado, ingrese otro!";
				}
				$array_response = array('tipo' => "ERROR", "Mensaje" => $mensaje);
				echo json_encode($array_response);		
			}
		}
		
		
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para crear un usuario en la base de datos
	*/
	public function api_insertar_usuario()
	{
		$this->load->model("usuarios_model");

		$post = $this->input->post();
		$post["clave"] = base64_encode($post["clave"]);

		$data_usuario = $this->usuarios_model->get_usuario_email($post["email"]);

		$data_usuario_documento = $this->usuarios_model->get_usuario_documento_insertar($post["numero_documento"]);

		if(count($data_usuario) == 0 && count($data_usuario_documento) == 0){
			$data = $this->usuarios_model->insertar_usuario($post);
			$array_response = array('tipo' => "OK", "Mensaje" => "¡Usuario creado con éxito!");
			echo json_encode($array_response);
		}else{
			$mensaje = "";
			if(count($data_usuario) > 0){
				$mensaje .= "¡El email " . $post["email"] . " ya se encuentra registrado, ingrese otro!";
			}
			if(count($data_usuario_documento) > 0){
				$mensaje .= " ¡El Numero de Documento " . $post["numero_documento"] . " ya se encuentra registrado, ingrese otro!";
			}
			$array_response = array('tipo' => "ERROR", "Mensaje" => $mensaje);
			echo json_encode($array_response);			
		}

		
		
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para borrar de la session los datos del usuario que inicio sesion
	*/
	public function api_cerrar_sesion()
	{
		$array_items = array('id_usuario_prueba', 'tipo_usuario_prueba');
		$this->session->unset_userdata($array_items);
		header("Location:" . base_url());
	}

}
	