<!--
    Tipo: Modal
    Descripcion: Modal para generar un abono a una factura seleccionada
-->
<div id="modal_abonos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Generar Abonos</h4>
      </div>
      <div class="modal-body">
        <form method="post" ng-submit="guardar_abono($event)">
          <div class="row">
            <div class="col-md-12">
              <label>Valor</label>
              <input type="text" class="form-control" ng-model="abono.abono" required>
            </div>
          </div>          
              
         
          <div class="row">
            <div class="col-md-12" align="right">
              <br><button type="submit" class="btn btn-primary">Abonar</button>
            </div>
          </div>
        
        </form>
      </div>
    </div>

  </div>
</div>