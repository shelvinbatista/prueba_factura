<!--
	Tipo: Body
	Descripcion: Codigo HTML para mostrar la vista del administrador de abonos, donde listan las facturas del cliente que inicia sesion, genera abonos a cualquiera de las facturas listadas y se puede ver los productos agregados a esa factura.
-->
<div class="container" ng-app="app_abonos" ng-controller="controller_abonos as table_facturas">
	<?= $modal_abono;?>
	<?= $modal_productos;?>
	<table ng-table="table_facturas.tableParams_facturas" class="table" show-filter="true">
	    <tr ng-repeat="factura in $data" align="center">
	        <td title="'Fecha'" sortable="'fecha'">
	            {{factura.fecha}}</td>
	        <td title="'Hora'" sortable="'hora'">
	            {{factura.hora}}</td>
	        <td title="'Total Factura'" sortable="'total'">
	            {{factura.total}}</td>
	        <td title="'Total Abonado'" sortable="'total_abonos'">
	            {{factura.total_abonos}}</td>
	        <td title="'Estado'" sortable="'estado'">
	            {{factura.estado}}</td>
	        <td title="'Productos'"><button class="btn btn-info" data-toggle="modal" data-target="#modal_productos" ng-click="ver_productos(factura.id)">Ver</button></td>
	        <td title="'Abonar'"><button class="btn btn-success" data-toggle="modal" data-target="#modal_abonos" ng-if="factura.total > factura.total_abonos" ng-click="seleccionar_factura(factura.id)">+</button></td>
	    </tr>
	</table>

</div>