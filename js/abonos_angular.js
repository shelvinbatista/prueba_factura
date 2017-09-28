	/*
		Tipo: Script
		Descripcion: Controller de angular que permite realizar acciones con respecto a los
		productos	
	*/

	'use strict';

	angular.module("app_abonos", ["ngTable"])
	.controller("controller_abonos", controller);

	controller.$inject = [
		"$scope",
		"$http",
		"$controller",
		"$httpParamSerializerJQLike",
		"$q",
		"NgTableParams"
	]
	function controller($scope, $http, $controller, $httpParamSerializerJQLike, $q, NgTableParams){
		$scope.abono = {}

		var self = this;

		/*
			Tipo: Funcion
			Descripcion: Funcion para listar todas las facturas de un cliente
		*/
		$scope.listar_facturas = function(){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_facturas/api_listar_facturas_cliente",
				data: $httpParamSerializerJQLike(),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){
				self.tableParams_facturas = new NgTableParams({}, { dataset: response.data});
			},
			function(error){
				console.log(error)
			})
		}
		$scope.listar_facturas();

		/*
			Tipo: Funcion
			Descripcion: Funcion para seleccionar una factura y guardar su id mientras se abre el modal de abonos
		*/
		$scope.seleccionar_factura = function(id_factura){
			$scope.abono.factura = id_factura
		}

		/*
			Tipo: Funcion
			Descripcion: Funcion para guardar abonos de facturas
		*/
		$scope.guardar_abono = function(){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_facturas/api_generar_abono",
				data: $httpParamSerializerJQLike($scope.abono),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){
				if(response.data.tipo == "OK"){
					alert(response.data.Mensaje)
					location.reload();
				}else{
					alert(response.data.Mensaje)
				}
			},
			function(error){
				console.log(error)
			})
		}

		/*
			Tipo: Funcion
			Descripcion: Funcion obtener y mostrar los datos de los productos agregados a una factura
		*/
		$scope.ver_productos = function(id_factura){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_facturas/api_obtener_productos_detalle",
				data: $httpParamSerializerJQLike({factura: id_factura}),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){
				self.tableParams_productos_factura = new NgTableParams({}, { dataset: response.data});
			},
			function(error){
				console.log(error)
			})
		}


	}

	

