<!--
    Tipo: Modal
    Descripcion: Modal para ver y modificar los datos de un producto seleccionado
-->
<div id="modal_editar_producto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Producto</h4>
      </div>
      <div class="modal-body">

        <form method="post" ng-submit="editar_producto($event)">

          <div class="row">
            <div class="col-md-12">
              <label>Nombre</label>
              <input type="text" class="form-control" ng-model="producto_editar.nombre" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Descripción</label>
              <textarea class="form-control" ng-model="producto_editar.descripcion" required></textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Precio</label>
              <input type="text" class="form-control" ng-model="producto_editar.precio" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Cantidad Stock</label>
              <input type="text" class="form-control" ng-model="producto_editar.cantidad_stock" required>
            </div>
          </div><br>

          <div class="row">
            <div class="col-md-12" align="right">
              <button class="btn btn-primary" type="submit">Editar</button>
            </div>
          </div>

        </form>
        

      </div>
    </div>

  </div>
</div>