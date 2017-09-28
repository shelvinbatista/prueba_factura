	/*
		Tipo: Script
		Descripcion: Controller de angular que permite realizar acciones con respecto a los
		productos	
	*/

	'use strict';

	angular.module("app_productos", ["ngTable"])
	.controller("controller_productos", controller);

	controller.$inject = [
		"$scope",
		"$http",
		"$controller",
		"$httpParamSerializerJQLike",
		"$q",
		"NgTableParams"
	]
	function controller($scope, $http, $controller, $httpParamSerializerJQLike, $q, NgTableParams){
		$scope.producto = {}
		$scope.producto_editar = {}

		var self = this;

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite listar los productos y mostrarlos en la pagina
		*/
		$scope.listar_productos = function(){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_productos/api_listar_productos",
				data: $httpParamSerializerJQLike({filtro: "Todos"}),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){
				self.tableParams = new NgTableParams({}, { dataset: response.data});
			},
			function(error){
				console.log(error)
			})
		}
		$scope.listar_productos();

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite obtener los datos de un producto
		*/
		$scope.get_producto = function(id){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_productos/api_obtener_producto",
				data: $httpParamSerializerJQLike({id_producto: id}),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){
				$scope.producto_editar.id_producto = response.data.id
				$scope.producto_editar.nombre = response.data.nombre
				$scope.producto_editar.descripcion = response.data.descripcion
				$scope.producto_editar.precio = response.data.precio
				$scope.producto_editar.cantidad_stock = response.data.cantidad_stock
			},
			function(error){
				console.log(error)
			})
		}

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite modificar los datos de un producto
		*/
		$scope.editar_producto = function(){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_productos/api_modificar_producto",
				data: $httpParamSerializerJQLike($scope.producto_editar),
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
			Descripcion: Funcion que permite crear un producto
		*/
		$scope.crear_producto = function(){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_productos/api_crear_producto",
				data: $httpParamSerializerJQLike($scope.producto),
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
	}

	

