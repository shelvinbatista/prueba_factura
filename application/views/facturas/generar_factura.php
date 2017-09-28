<!--
	Tipo: Body
	Descripcion: Codigo HTML para mostrar la vista generar una factura donde se listan los productos, se agregan, se muestran en la paginas los productos que se agregan y al final se genera un PDF con la factura
-->
<div class="container" ng-app="app_facturas" ng-controller="controller_facturas">
	<form ng-submit="generar_factura($event)">
		<div class="col-md-12" align="right">
			
			<div class="col-md-7">
			</div>
			<div class="col-md-3" align="left" ng-if="productos_pedido.length > 0">
				<label>Valor Total:</label>
				<input type="text" class="form-control pull-right" readonly="readonly" ng-model="pedido_generar.total">
			</div>
			<div class="col-md-2" align="right"><br>
				<button class="btn btn-primary" ng-if="productos_pedido.length > 0" type="submit">Pagar</button>
			</div>
			
			
		</div>
		<div class="col-md-12">
			<fieldset>
				<legend>Datos del Cliente</legend>

				<div class="row">
					<div class="col-md-4">
						<label>Documento buscar</label>
						<input type="text" class="form-control" ng-change="buscar_datos_cliente()" ng-model="datos_cliente.documento" required>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label>Nombre</label>
						<input type="text" class="form-control" readonly="readonly" ng-model="datos_cliente.nombres" required>
					</div>
					<div class="col-md-3">
						<label>Apellidos</label>
						<input type="text" class="form-control" readonly="readonly" ng-model="datos_cliente.apellidos" required>
					</div>
					<div class="col-md-3">
						<label>Dirección</label>
						<input type="text" class="form-control" readonly="readonly" ng-model="datos_cliente.direccion" required>
					</div>
					<div class="col-md-3">
						<label>Telefono</label>
						<input type="text" class="form-control" readonly="readonly" ng-model="datos_cliente.telefono" required>
					</div>
				</div>
			</fieldset>
		</div>
	</form>
	<div class="col-md-8">
		<div class="col-md-4" align="center" ng-repeat="(key, value) in productos_listado">
			<fieldset>		
				<label>{{value.nombre}}</label><br>
				<label><font color="red">{{value.precio}}</font></label>
				<img width="100%" src="<?= base_url();?>img/images.png">
				<label>{{value.descripcion}}</label><br>

				<div class="col-md-6" align="center" style="padding: 0px">
					<input type="number" class="form-control" min="1" ng-model="value.cantidad_pedir" value="1">
				</div>	
				<div class="col-md-1" style="padding: 0px"></div>
				<div class="col-md-3" align="center" style="padding: 0px">
					<button type="button" class="btn btn-success" ng-click="agregar_producto_factura(value.cantidad_pedir, value.id, key)">Agregar</button>
				</div>				
			</fieldset>
		</div>

	</div>

	<div class="col-md-4">
		<table class="table" show-filter="true">
			<thead>
				<th>Producto</th>
				<th>Cantidad</th>
				<th>Total</th>
				<th>Borrar</th>
			</thead>
			<tbody>
				<tr ng-repeat="(key, value) in productos_pedido">
					<td>{{value.nombre}}</td>
					<td>{{value.cantidad_pedir}}</td>
					<td>{{value.total}}</td>
					<td><button class="btn btn-danger" ng-click="borrar_producto_factura(key)">Borrar</button></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>