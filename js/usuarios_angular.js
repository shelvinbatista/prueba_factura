	/*
		Tipo: Script
		Descripcion: Controller de angular que permite realizar acciones con respecto al usuario
		por ejemplo login	
	*/

	'use strict';

	angular.module("app_usuarios", ["ngTable"])
	.controller("controller_usuarios", controller);

	controller.$inject = [
		"$scope",
		"$http",
		"$controller",
		"$httpParamSerializerJQLike",
		"$q",
		"NgTableParams"
	]
	function controller($scope, $http, $controller, $httpParamSerializerJQLike, $q, NgTableParams){
		$scope.usuario_login = {}
		$scope.usuario_editar = {}
		$scope.usuario_perfil = {}
		$scope.usuario = {}
		$scope.usuario.tipo_usuario = "Empleado"
		$scope.usuario.tipo_documento = "CC"
		$scope.usuario_perfil.tipo_usuario = "Empleado"
		$scope.usuario_perfil.tipo_documento = "CC"

		var self = this;

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite iniciar sesion
		*/
		$scope.iniciar_sesion = function(){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_usuarios/api_iniciar_sesion",
				data: $httpParamSerializerJQLike($scope.usuario_login),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){
				window.location.href = URL_SERVER_WS + "index.php/home"
			},
			function(error){
				console.log(error)
			})
		}

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite listar los usuarios y mostrarlos en la pagina
		*/
		$scope.listar_usuarios = function(){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_usuarios/api_listar_usuarios",
				data: $httpParamSerializerJQLike(),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){
				self.tableParams_usuarios = new NgTableParams({}, { dataset: response.data});
			},
			function(error){
				console.log(error)
			})
		}
		$scope.listar_usuarios();

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite obtener los datos de un usuario seleccionado
		*/
		$scope.obtener_usuario = function(id){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_usuarios/api_obtener_usuario",
				data: $httpParamSerializerJQLike({id_usuario: id}),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){
				$scope.usuario_editar.id_usuario = response.data.id
				$scope.usuario_editar.nombres = response.data.nombres
				$scope.usuario_editar.apellidos = response.data.apellidos
				$scope.usuario_editar.tipo_usuario = response.data.tipo_usuario
				$scope.usuario_editar.tipo_documento = response.data.tipo_documento
				$scope.usuario_editar.numero_documento = response.data.numero_documento
				$scope.usuario_editar.numero_documento_original = response.data.numero_documento
				$scope.usuario_editar.email = response.data.email
				$scope.usuario_editar.email_original = response.data.email
				$scope.usuario_editar.clave = response.data.clave
				$scope.usuario_editar.direccion = response.data.direccion
				$scope.usuario_editar.telefono = response.data.telefono
			},
			function(error){
				console.log(error)
			})
		}

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite obtener los datos de un usuario que inicio sesion
		*/
		$scope.obtener_usuario_session = function(){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_usuarios/api_obtener_usuario_session",
				data: $httpParamSerializerJQLike(),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){console.log(response.data)
				$scope.usuario_perfil.id_usuario = response.data.id
				$scope.usuario_perfil.nombres = response.data.nombres
				$scope.usuario_perfil.apellidos = response.data.apellidos
				$scope.usuario_perfil.tipo_usuario = response.data.tipo_usuario
				$scope.usuario_perfil.tipo_documento = response.data.tipo_documento
				$scope.usuario_perfil.numero_documento = response.data.numero_documento
				$scope.usuario_perfil.email = response.data.email
				$scope.usuario_perfil.clave = response.data.clave
				$scope.usuario_perfil.direccion = response.data.direccion
				$scope.usuario_perfil.telefono = response.data.telefono
			},
			function(error){
				console.log(error)
			})
		}
		$scope.obtener_usuario_session()

		/*
			Tipo: Funcion
			Descripcion: Funcion que permite modificar los datos de un usuario seleccionado
		*/
		$scope.editar_usuario = function(id){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_usuarios/api_modificar_usuario",
				data: $httpParamSerializerJQLike($scope.usuario_editar),
				headers: {"Content-type": "application/x-www-form-urlencoded"}
			}).then(function(response){console.log(response.data)
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
			Descripcion: Funcion que permite modificar los datos de un usuario que inicio sesion
		*/
		$scope.editar_perfil= function(id){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_usuarios/api_modificar_usuario",
				data: $httpParamSerializerJQLike($scope.usuario_perfil),
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
			Descripcion: Funcion que permite crear un usuario
		*/
		$scope.crear_usuario = function(id){
			$http({
				method: "post",
				url: URL_SERVER_WS + "index.php/Services_usuarios/api_insertar_usuario",
				data: $httpParamSerializerJQLike($scope.usuario),
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

	

