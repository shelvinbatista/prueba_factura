<!--
    Tipo: Modal
    Descripcion: Modal para crear un producto
-->
<div id="modal_crear_producto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Crear Producto</h4>
      </div>
      <div class="modal-body">

        <form method="post" ng-submit="crear_producto($event)">

          <div class="row">
            <div class="col-md-12">
              <label>Nombre</label>
              <input type="text" class="form-control" ng-model="producto.nombre" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Descripción</label>
              <textarea class="form-control" ng-model="producto.descripcion" required></textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Precio</label>
              <input type="text" class="form-control" ng-model="producto.precio" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Cantidad Stock</label>
              <input type="text" class="form-control" ng-model="producto.cantidad_stock" required>
            </div>
          </div><br>

          <div class="row">
            <div class="col-md-12" align="right">
              <button class="btn btn-primary" type="submit">Crear</button>
            </div>
          </div>

        </form>
        

      </div>
    </div>

  </div>
</div>