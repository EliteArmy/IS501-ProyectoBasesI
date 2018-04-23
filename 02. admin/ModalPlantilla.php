  <!-- Modal -->
  <div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">
          Información sobre Modal</h5>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
          <form role="form">
            
            <div style="display: none" class="form-group">
              <label for="txt-id">Id</label>
              <input type="text" class="form-control" id="txt-id">
            </div>

            <div class="form-group">
              <label for="txt-primer-nombre">Primer Nombre</label>
              <input type="text" class="form-control" id="txt-primer-nombre" placeholder="Ingrese el Primer Nombre">
            </div>

            <div class="form-group">
              <label for="txt-segundo-nombre">Segundo Nombre</label>
              <input type="text" class="form-control" id="txt-segundo-nombre" placeholder="Ingrese el Segundo Nombre">
            </div>
            
            <div class="form-group">
              <label for="txt-primer-apellido">Primer Apellido</label>
              <input type="text" class="form-control" id="txt-primer-apellido" placeholder="Ingrese el Primer Apellido">
            </div>

            <div class="form-group">
              <label for="txt-segundo-apellido">Segundo Apellido</label>
              <input type="text" class="form-control" id="txt-segundo-apellido" placeholder="Ingrese el Segundo Apellido">
            </div>
            
            <div class="form-group">
              <label for="txt-email">Email</label>
              <input type="email" class="form-control" id="txt-email" placeholder="Ingrese el correo electrónico">
            </div>

            <div class="form-group">
              <label for="txt-telefono">Telefono</label>
              <input type="text" class="form-control" id="txt-telefono" placeholder="Ingrese el Telefono">
            </div>
            
            <div class="form-group">
              <label for="txt-fecha-">Fecha</label>
              <input type="date" class="form-control" id="txt-fecha-">
            </div>

            <div class="form-group">
              <label for="slc-estado">Nombre</label>
                <select id="slc-estado" class="form-control">
                
                <option>Seleccione una Opción</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
              </select>
            </div>

            <div class="form-group">
              <label for="txt-direccion">Dirección</label>
              <textarea class="form-control" id="txt-direccion" placeholder="Ingrese la dirección"></textarea>
            </div>

            <button type="button" class="btn btn-primary submitBtn" onclick="actualizarDato(document.getElementById('txt-id').value)">Actualizar</button>

            <button type="reset" value="Reset" class="btn btn-warning">Limpiar Formulario</button>
            
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

          </form>
        </div>
        
        <!-- Modal Footer -->
        <div class="modal-footer">
          
        </div>

      </div>
    </div>
  </div>