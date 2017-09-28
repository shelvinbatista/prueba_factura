<!--
    Tipo: Body
    Descripcion: Codigo HTML para mostrar la vista generar PDF de una factura con los datos de la factura y los productos agregados
-->
<!DOCTYPE html>
<html>
<head>
	<title>Factura</title>
	<style type="text/css">
		thead th{
			background-color: #337ab7;
			color: #FFFFFF;
			font-size: 14px;
			padding-left: 10px;
		}
		thead td, tbody td{
			background-color: #e7e7e7;
			padding-left: 10px;
			font-size: 13px;
		}
		.blanco{
			background-color: #FFFFFF;
		}
	</style>
</head>
<body>
	<?php
    	if(count($factura) == 1){
    		$factura = $factura[0];
    	}
    ?>
	<table width="100%" border="0">
    	<thead>
    		<tr align="left">
				<td width="60%" class="blanco">&nbsp;</td>
				<td width="80%" class="blanco" align="right"><h2><i>Factura Número <?= $factura->id;?></i></h2></td>
    		</tr>
    	</thead>
    </table>
    
	<table width="100%" border="0">
    	<thead>
    		<tr align="left">
				<th width="20%">Nombres: </th>
				<td width="80%"><?= $factura->nombres;?></td>
    		</tr>
    		<tr align="left">
				<th width="20%">Apellidos: </th>
				<td width="80%"><?= $factura->apellidos;?></td>
    		</tr>
    		<tr align="left">
				<th width="20%">Fecha: </th>
				<td width="80%"><?= $factura->fecha . " " . $factura->hora;?></td>
    		</tr>
    		<tr align="left">
				<th width="20%">Dirección: </th>
				<td width="80%"><?= $factura->direccion;?></td>
    		</tr>
    		<tr align="left">
				<th width="20%">Telefono: </th>
				<td width="80%"><?= $factura->telefono;?></td>
    		</tr>
    	</thead>
    </table><br>

    <table width="100%" border="0">
    	<thead>
    		<tr>
				<th>Producto</th>
				<th>Cantidad</th>
				<th>Precio</th>
				<th>Total</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
    			foreach ($detalle as $value) {
    		?>
    			<tr align="center">
    				<td><?= $value->nombre;?></td>
    				<td><?= $value->cantidad;?></td>
    				<td><?= $value->precio;?></td>
    				<td><?= $value->total;?></td>
    			</tr>
    		<?php
    			}
    		?>
    	</tbody>
    </table><br>

    <table width="100%" border="0">
    	<thead>
    		<tr>
				<td width="60%" class="blanco">&nbsp;</td>
				<th width="20%">Valor Total: </th>
				<td width="20%"><?= $factura->total;?></td>
			</tr>
		</thead>
	</table>
</body>
</html>