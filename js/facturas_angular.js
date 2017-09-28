	/*
		Tipo: Script
		Descripcion: Controller de angular que permite realizar acciones con respecto a los
		productos	
	*/

	'use strict';

	angular.module("app_facturas", ["ngTable"])
	.controller("controller_facturas", controller);

	controller.$inject = [
		"$scope",
		"$http",
		"$controller",
		"$httpParamSerializerJQLike",
		"$q",
		"NgTableParams"
	]
	function controller($scope, $http, $controller, $httpParamSerializerJQLike, $q, NgTableParams){
		$scope.productos_listado = []
		$scope.productos_pedido = []
		$scope.datos_cliente = {}
		$scope.pedido_generar = {}

		var self = this;

		/*
			Tipo: Funcion
			Descripcion: Funcion listar y mostrar los productos disponibles a agregar a facturas
		*/
		$scope.listar_productos_pagar = function(){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_productos/api_listar_productos",
				data: $httpParamSerializerJQLike({filtro: "Factura"}),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){
				$scope.productos_listado = response.data
				angular.forEach($scope.productos_listado, function(response){
					response.cantidad_pedir = 1
				})
			},
			function(error){
				console.log(error)
			})
		}
		$scope.listar_productos_pagar();

		/*
			Tipo: Funcion
			Descripcion: Funcion obtener los datos de un cliente consultandolo por su numero de documento
		*/
		$scope.buscar_datos_cliente = function(){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_usuarios/api_buscar_documento",
				data: $httpParamSerializerJQLike({documento_buscar: $scope.datos_cliente.documento, tipo: "Cliente"}),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){
				$scope.datos_cliente.id_cliente = response.data.id
				$scope.datos_cliente.nombres = response.data.nombres
				$scope.datos_cliente.apellidos = response.data.apellidos
				$scope.datos_cliente.direccion = response.data.direccion
				$scope.datos_cliente.telefono = response.data.telefono
			},
			function(error){
				console.log(error)
			})
		}

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite agregar un producto al json de productos de la factura
			o actualizar la cantidad agregada de un producto
		*/
		$scope.agregar_producto_factura = function(cantidad, id_producto, index){
			var estado = $scope.existe_producto(id_producto)
			console.log(estado)
			if(estado == -1){
				
				$http({
					method: "post",
					url: URL_SERVER_WS + "index.php/Services_productos/api_obtener_producto",
					data: $httpParamSerializerJQLike({id_producto: id_producto}),
					headers: {"Content-type": "application/x-www-form-urlencoded"}
				}).then(function(response){
					if(parseFloat(cantidad) <= parseFloat(response.data.cantidad_stock)){
						$scope.productos_pedido.push({
							id_producto: response.data.id,
							nombre: response.data.nombre,
							cantidad_pedir: parseFloat(cantidad),
							cantidad_stock: parseFloat(response.data.cantidad_stock),
							precio: response.data.precio,
							total: parseFloat(response.data.precio) * parseFloat(cantidad)
						})
						$scope.obtener_total_factura();
					}else{
						alert("¡No hay suficientes productos en stock! Actualmente hay " + response.data.cantidad_stock)
					}
					
				},
				function(error){
					console.log(error)
				})
			}else{
				var cantidad_pedir = $scope.productos_pedido[estado].cantidad_pedir + parseFloat(cantidad)
				$scope.productos_pedido[estado] = {
					id_producto: $scope.productos_pedido[estado].id_producto,
					nombre: $scope.productos_pedido[estado].nombre,
					cantidad_pedir: cantidad_pedir,
					precio: $scope.productos_pedido[estado].precio,
					total: parseFloat($scope.productos_pedido[estado].precio) * cantidad_pedir
				}
				$scope.obtener_total_factura();
			}
			$scope.productos_listado[index].cantidad_pedir = 1
		}

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite validar si un producto esta agregado en el json de productos de la factura
		*/
		$scope.existe_producto = function(id_producto){
			var estado = -1;
			var indice = 0;
			angular.forEach($scope.productos_pedido, function(data){
				if(data.id_producto == id_producto){
					estado = indice;
				}
				indice++;
			})

			return estado;
		}

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite obtener el valor total de la factura
		*/
		$scope.obtener_total_factura = function(id_producto){
			var valor_total = 0;
			angular.forEach($scope.productos_pedido, function(data){
				valor_total += data.total;
			})
			$scope.pedido_generar.total = valor_total
		}

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite borrar un producto del json de la factura
		*/
		$scope.borrar_producto_factura = function(indice){
			$scope.productos_pedido.splice(indice, 1)
			$scope.obtener_total_factura()
		}

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite generar la factura y mostrar un PDF con los datos basicos y los productos agregados
		*/
		$scope.generar_factura = function(){
			$scope.pedido_generar.productos = $scope.productos_pedido
			$scope.pedido_generar.id_cliente = $scope.datos_cliente.id_cliente
			$scope.pedido_generar.estado = "ACTIVO"

			if($scope.datos_cliente.id_cliente != null && $scope.datos_cliente.documento != null){
				$http({
					method: "post",
					url: URL_SERVER_WS + "index.php/Services_facturas/api_generar_factura",
					data: $httpParamSerializerJQLike($scope.pedido_generar),
					headers: {"Content-type": "application/x-www-form-urlencoded"}
				}).then(function(response){
					alert(response.data.Mensaje)

					var sOptions = 'status=yes,menubar=no,scrollbars=yes,resizable=yes,toolbar=yes, statusbar=no';
	                  sOptions = sOptions + ',width=' + (screen.availWidth).toString();
	                  sOptions = sOptions + ',height=' + (screen.availHeight - 10).toString();
	                  sOptions = sOptions + ',screenX=-10,screenY=0,left=-10,top=0';

                  	window.open(URL_SERVER_WS + "index.php//Services_facturas/pdf_factura?factura=" + response.data.id_factura, "Factura", sOptions);

					$scope.listar_productos_pagar();
					$scope.productos_pedido = []
					$scope.datos_cliente = {}
					$scope.pedido_generar = {}
				},
				function(error){
					console.log(error)
				})
			}else{
				if($scope.datos_cliente.id_cliente == null && $scope.datos_cliente.documento != null){
					alert("¡El cliente consultado no existe. Debe usar un cliente que este registrado para generar la factura!")
				}else{
					alert("¡Debe consultar primero los datos del clientes antes de generar la factura!")
				}

			}
			
		}
	}

	

