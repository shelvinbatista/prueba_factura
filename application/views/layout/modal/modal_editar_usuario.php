<!--
    Tipo: Modal
    Descripcion: Modal para ver y modificar los datos de un usuario seleccionado
-->
<div id="modal_editar_usuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Usuario</h4>
      </div>
      <div class="modal-body">

        <form method="post" ng-submit="editar_usuario($event)">

          <div class="row">
            <div class="col-md-12">
              <label>Nombres</label>
              <input type="text" class="form-control" ng-model="usuario_editar.nombres" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Apellidos</label>
              <input type="text" class="form-control" ng-model="usuario_editar.apellidos" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Tipo de Usuario</label>
              <select class="form-control" ng-model="usuario_editar.tipo_usuario">
                <option value="Empleado">Empleado</option>
                <option value="Cliente">Cliente</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Tipo de Documento</label>
              <select class="form-control" ng-model="usuario_editar.tipo_documento">
                <option value="CC">Cédula de Ciudadania</option>
                <option value="Cedula de Extranjero">Cédula de Extranjero</option>
                <option value="Pasaporte">Pasaporte</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Número de Documento</label>
              <input type="text" class="form-control" ng-model="usuario_editar.numero_documento" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Email</label>
              <input type="email" class="form-control" ng-model="usuario_editar.email" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Clave</label>
              <input type="password" class="form-control" ng-model="usuario_editar.clave" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Dirección</label>
              <input type="text" class="form-control" ng-model="usuario_editar.direccion" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Telefono</label>
              <input type="text" class="form-control" ng-model="usuario_editar.telefono" required>
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