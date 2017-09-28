<!--
	Tipo: Body
	Descripcion: Codigo HTML para administrar los usuarios, donde se puede listar, consultar, crear y modificar usuarios.
-->
<div class="container" ng-app="app_usuarios" ng-controller="controller_usuarios as table_usuarios">
	<?= $modal_editar_usuario;?>
	<?= $modal_crear_usuario;?>
	<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal_crear_usuario">AGREGAR</button><br><br>
	<table ng-table="table_usuarios.tableParams_usuarios" class="table" show-filter="true">
	    <tr ng-repeat="usuario in $data" align="center">
	        <td title="'Nombres'" sortable="'nombres'">
	            {{usuario.nombres}}</td>
	        <td title="'Apellidos'" sortable="'apellidos'">
	            {{usuario.apellidos}}</td>
	        <td title="'Tipo de Usuario'" sortable="'tipo_usuario'">
	            {{usuario.tipo_usuario}}</td>
	        <td title="'Tipo de Documento'" sortable="'tipo_documento'">
	            {{usuario.tipo_documento}}</td>
	        <td title="'Número de Documento'" sortable="'numero_documento'">
	            {{usuario.numero_documento}}</td>
	        <td title="'Email'" sortable="'email'">
	            {{usuario.email}}</td>
	        <td title="'Dirección'" sortable="'direccion'">
	            {{usuario.direccion}}</td>
	        <td title="'Telefono'" sortable="'telefono'">
	            {{usuario.telefono}}</td>
	        <td title="'Editar'"><button class="btn btn-info" data-toggle="modal" data-target="#modal_editar_usuario" ng-click="obtener_usuario(usuario.id)">Editar</button></td>
	    </tr>
	</table>

</div>