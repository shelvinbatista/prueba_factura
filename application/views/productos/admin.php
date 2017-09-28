<!--
	Tipo: Body
	Descripcion: Codigo HTML para administrar los productos, donde se puede listar, consultar, crear y modificar productos.
-->
<div class="container" ng-app="app_productos" ng-controller="controller_productos as table_productos">
	<?= $modal_editar_producto;?>
	<?= $modal_crear_producto;?>
	<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal_crear_producto">AGREGAR</button><br><br>
	<table ng-table="table_productos.tableParams" class="table" show-filter="true">
	    <tr ng-repeat="producto in $data" align="center">
	        <td title="'Nombre'" sortable="'nombre'">
	            {{producto.nombre}}</td>
	        <td title="'Descripcion'" sortable="'descripcion'">
	            {{producto.descripcion}}</td>
	        <td title="'Precio'" sortable="'precio'">
	            {{producto.precio}}</td>
	        <td title="'Cantidad Stock'" sortable="'cantidad_stock'">
	            {{producto.cantidad_stock}}</td>
	        <td title="'Editar'"><button class="btn btn-info" data-toggle="modal" data-target="#modal_editar_producto" ng-click="get_producto(producto.id)">Editar</button></td>
	    </tr>
	</table>

</div>