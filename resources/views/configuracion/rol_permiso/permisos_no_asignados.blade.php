<select class="form-control" id="cbo_permisos_noasigandos" name="cbo_permisos_noasigandos" size="10" onclick="activar_asignar()"> 
      @foreach($permisos_sin_asignar as $asignados)
      <option value="{{$asignados->id}}">{{$asignados->per_descripcion}}</option>
      @endforeach                 
</select>