<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
	Tipo: Controller
	Descripcion: Controlador que permite configurar los servicios a consumir que cumplen diversas funciones relacionados con las facturas
*/
class Services_facturas extends CI_Controller {	
	/*
		Tipo: Servicio
		Descripcion: Funcion para generar y guardar los datos de una factura en la base de datos, para despues mostrar la factura en un PDF
	*/
	public function api_generar_factura()
	{
		$this->load->model("facturas_model");
		$this->load->model("detalle_factura_model");
		$this->load->model("productos_model");

		$post = $this->input->post();

		$id_factura = $this->facturas_model->insertar_factura($post);

		//Se iteran los productos para guardarlos en la base de datos
		foreach ($post["productos"] as $value) {
			$array_producto = array(
				'factura' =>  $id_factura,
				'producto' =>  $value["id_producto"],
				'cantidad' =>  $value["cantidad_pedir"],
				'precio' =>  $value["precio"],
				'total' =>  $value["total"],
				'estado' =>  "ACTIVO"
			);
			$this->detalle_factura_model->insertar_detalle($array_producto);

			//Se consulta el producto para saber la cantidad exacta y restarle la cantidad solicitada en el inventario
			$data_producto = $this->productos_model->get_producto($value["id_producto"]);

			if(count($data_producto) == 1){
				$data_producto = $data_producto[0];

				$cantidad_inventario = $data_producto->cantidad_stock - $value["cantidad_pedir"];

				$array_inventario = array(
					'producto' =>  $value["id_producto"],
					'cantidad' =>  $cantidad_inventario
				);
				$this->productos_model->modificar_producto($array_inventario);
			}
		}

		//Se genera un array que se pasara como respuesta del servicio
		$array_response = array('tipo' => "OK", "Mensaje" => "¡Factura generada con éxito!", "id_factura" => $id_factura);
		echo json_encode($array_response);
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para generar y guardar los datos de un abono una factura en la base de datos
	*/
	public function api_generar_abono()
	{
		$this->load->model("facturas_model");
		$this->load->model("detalle_factura_model");
		$this->load->model("pagos_model");

		$post = $this->input->post();		

		//Se consulta los datos de la factura para calcular el saldo de lo que se debe en la factura y otras validaciones para aceptar o no el abono realizado
		$data_factura = $this->facturas_model->get_factura($post["factura"]);
		if(count($data_factura) == 1){
			$data_factura = $data_factura[0];
		}

		$data_abonos = $this->pagos_model->get_pagos($post["factura"]);

		$total_abonos = 0;

		//Se calcula el total de abonos realizados a la factura hasta el momento
		foreach ($data_abonos as $value_abono) {
			$total_abonos += $value_abono->valor_abono;
		}

		$saldo = $data_factura->total - $total_abonos;

		//Si hay saldo por pagar se regista el abono y se genera un array que se pasara como respuesta del servicio, sino se genera un mensaje de error como respuesta
		if($saldo > 0){									

			if($post["abono"] > $saldo){
				$cambio = $post["abono"] - $saldo;

				$mensaje = "¡Abono generado con éxito! Cantidad Abonada: " . $post["abono"] . ", Cambio: " . $cambio; 

				$post["abono"] = $saldo;
				$this->pagos_model->insertar_pago($post);

				$array_factura = array(
					'factura' =>  $post["factura"],
					'estado' =>  "PAGADA"
				);
				$this->facturas_model->modificar_factura($array_factura);

				$array_response = array('tipo' => "OK", "Mensaje" => $mensaje);
				echo json_encode($array_response);
			}else{
				$this->pagos_model->insertar_pago($post);

				$array_factura = array(
					'factura' =>  $post["factura"],
					'estado' =>  "PAGADA"
				);
				$this->facturas_model->modificar_factura($array_factura);

				$array_response = array('tipo' => "OK", "Mensaje" => "¡Abono generado con éxito!");
				echo json_encode($array_response);
			}
			
		}else{
			$array_response = array('tipo' => "ERROR", "Mensaje" => "¡La Factura seleccionada ya se ha pagado por completo. No es necesario realizar abonos!");
			echo json_encode($array_response);
		}

		
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para listar las facturas que ha hecho un cliente que inicia sesion en el sistema
	*/
	public function api_listar_facturas_cliente()
	{
		$this->load->model("facturas_model");
		$this->load->model("pagos_model");

		$post = $this->input->post();
		$id_cliente = $this->session->userdata('id_usuario_prueba');
		$data = $this->facturas_model->listar_facturas($id_cliente);

		//Se debe calcular el total de los abonos que ha hecho a cada factura para mostrar esta informacion y para validar si puede hacer otro abono o no
		foreach ($data as $value) {
			$data_abonos = $this->pagos_model->get_pagos($value->id);

			$total_abonos = 0;

			foreach ($data_abonos as $value_abono) {
				$total_abonos += $value_abono->valor_abono;
			}
			$value->total_abonos = $total_abonos;
		}
		echo json_encode($data);
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para obtener los productos agregados en una factura ya registrada en la base de datos
	*/
	public function api_obtener_productos_detalle()
	{
		$this->load->model("detalle_factura_model");

		$post = $this->input->post();

		$data = $this->detalle_factura_model->get_detalle($post["factura"]);
		
		echo json_encode($data);
	}

	/*
		Tipo: Servicio
		Descripcion: Funcion para para generar el PDF de una factura pasandole el id de la factura. Este proceso se ejecuta despues de haber generado la factura. Se usa un vista como plantilla de diseño para el contenido del PDF y a este se le pasan los datos a mostrar.
	*/    
    public function pdf_factura()
    {
		$get = $this->input->get();
		$this->load->model("facturas_model");
		$this->load->model("detalle_factura_model");

        //Carga la librería que agregamos
        $this->load->library('pdf');
        //$saludo será una variable dentro la vista
        $data["factura"] = $this->facturas_model->get_factura($get["factura"]);
        $data["detalle"] = $this->detalle_factura_model->get_detalle($get["factura"]);
        //$html tendrá el contenido de la vista
        $html = $this->load->view('facturas/pdf_factura', $data, true);
       
        $this->pdf->load_html($html);
        $this->pdf->render();
        $this->pdf->stream("factura.pdf", array(
            "Attachment" => false
        ));
    }


}
	