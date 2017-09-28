<!--
    Tipo: Modal
    Descripcion: Modal para ver los datos de los productos de una factura seleccionada
-->
<div id="modal_productos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Productos</h4>
      </div>
      <div class="modal-body">
        <table ng-table="table_facturas.tableParams_productos_factura" class="table" show-filter="true">
          <tr ng-repeat="producto in $data" align="center">
            <td title="'Nombre'" sortable="'nombre'">
              {{producto.nombre}}</td>
            <td title="'Descripcion'" sortable="'descripcion'">
                {{producto.descripcion}}</td>
            <td title="'Cantidad'" sortable="'cantidad'">
                {{producto.cantidad}}</td>
            <td title="'Precio'" sortable="'precio'">
                {{producto.precio}}</td>
            <td title="'Total'" sortable="'total'">
                {{producto.total}}</td>
          </tr>
        </table><br><br><br>
      </div>
    </div>

  </div>
</div>