<select class="form-control" id="cbo_permisos_asigandos" name="cbo_permisos_asigandos" size="10" onclick="activar_quitar()"> 
      @foreach($permisos_asignados as $asignados)
      <option value="{{$asignados->permiso_rol_id}}">{{$asignados->per_descripcion}}</option>
      @endforeach                 
</select>