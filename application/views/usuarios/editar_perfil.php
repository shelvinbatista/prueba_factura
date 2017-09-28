<!--
    Tipo: Body
    Descripcion: Codigo HTML para ver y modificar los datos del usuario que inicio sesion
-->
<div class="container" ng-app="app_usuarios" ng-controller="controller_usuarios as table_usuarios">
	<form method="post" ng-submit="editar_perfil($event)">

      <div class="row">
        <div class="col-md-12">
          <label>Nombres</label>
          <input type="text" class="form-control" ng-model="usuario_perfil.nombres" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label>Apellidos</label>
          <input type="text" class="form-control" ng-model="usuario_perfil.apellidos" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label>Tipo de Usuario</label>
          <select class="form-control" ng-model="usuario_perfil.tipo_usuario">
            <option value="Empleado">Empleado</option>
            <option value="Cliente">Cliente</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label>Tipo de Documento</label>
          <select class="form-control" ng-model="usuario_perfil.tipo_documento">
            <option value="CC">Cédula de Ciudadania</option>
            <option value="Cedula de Extranjero">Cédula de Extranjero</option>
            <option value="Pasaporte">Pasaporte</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label>Número de Documento</label>
          <input type="text" class="form-control" ng-model="usuario_perfil.numero_documento" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label>Email</label>
          <input type="email" class="form-control" ng-model="usuario_perfil.email" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label>Clave</label>
          <input type="password" class="form-control" ng-model="usuario_perfil.clave" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label>Dirección</label>
          <input type="text" class="form-control" ng-model="usuario_perfil.direccion" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label>Telefono</label>
          <input type="text" class="form-control" ng-model="usuario_perfil.telefono" required>
        </div>
      </div><br>

      <div class="row">
        <div class="col-md-12" align="right">
          <button class="btn btn-primary" type="submit">Editar</button>
        </div>
      </div>

    </form>
</div>