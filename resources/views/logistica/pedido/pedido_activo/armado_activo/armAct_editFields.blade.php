***<BR>
*<BR>
*<BR>
*<BR>
FALTA AGREGAR OPCION DE ESTATUS CON LA OPCION SIN ENTREGA POR FALTA DE INFORMACIÓN, REGRESAR A PRODUCCIÓN AGREGANDO CAMPO EN LA BD varchar regre(true o false)<BR>

<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="estatus">{{ __('Estatus') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('estatus', config('opcionesSelect.select_estatus_armado_produccion'), $armado->estat, ['class' => 'form-control select2' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('estatus') }}</span>
  </div>
</div>

*<BR>
  *<BR>
  *<BR>
  **<BR>
  
  
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentario_armado">{{ __('Comentario armado') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentario_armado', $armado->coment_log, ['class' => 'form-control' . ($errors->has('comentario_armado') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentario armado'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentario_armado') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('logistica.pedidoActivo.edit', Crypt::encrypt($armado->pedido->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con el pedido') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'logisticaPedidoActivoArmadoUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar armado') }}</button>
  </div>
</div>