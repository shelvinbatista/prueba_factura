<!--
    Tipo: Modal
    Descripcion: Modal para crear un usuario
-->
<div id="modal_crear_usuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Crear Usuario</h4>
      </div>
      <div class="modal-body">

        <form method="post" ng-submit="crear_usuario($event)">

          <div class="row">
            <div class="col-md-12">
              <label>Nombres</label>
              <input type="text" class="form-control" ng-model="usuario.nombres" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Apellidos</label>
              <input type="text" class="form-control" ng-model="usuario.apellidos" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Tipo de Usuario</label>
              <select class="form-control" ng-model="usuario.tipo_usuario">
                <option value="Empleado">Empleado</option>
                <option value="Cliente">Cliente</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Tipo de Documento</label>
              <select class="form-control" ng-model="usuario.tipo_documento">
                <option value="CC">Cédula de Ciudadania</option>
                <option value="Cedula de Extranjero">Cédula de Extranjero</option>
                <option value="Pasaporte">Pasaporte</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Número de Documento</label>
              <input type="text" class="form-control" ng-model="usuario.numero_documento" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Email</label>
              <input type="email" class="form-control" ng-model="usuario.email" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Clave</label>
              <input type="password" class="form-control" ng-model="usuario.clave" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Dirección</label>
              <input type="text" class="form-control" ng-model="usuario.direccion" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <label>Telefono</label>
              <input type="text" class="form-control" ng-model="usuario.telefono" required>
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