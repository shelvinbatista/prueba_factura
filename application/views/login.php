<!--
    Tipo: Body
    Descripcion: Modal para mostrar la pagina home que sale despues de iniciar sesion
-->
<div id="container" ng-app="app_usuarios" ng-controller="controller_usuarios">
	<h1>Inicio de Sesión</h1>

	<div id="body">
		<form enctype="multipart/form-data" method="post" ng-submit="iniciar_sesion($event)">
			<div class="form-group">
				<label>Usuario: </label>
				<input type="text" class="form-control" ng-model="usuario_login.email" required>
			</div>	
			<div class="form-group">
				<label>Contraseña: </label>
				<input type="password" class="form-control" ng-model="usuario_login.clave" required>
			</div>	
			<button type="submit" class="btn btn-primary">Entrar</button>
		</form><br>
	</div>

</div>



