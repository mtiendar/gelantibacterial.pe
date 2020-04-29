{!! Form::open(['route' => ['cotizacion.armado.store', Crypt::encrypt($cotizacion->id)], 'onsubmit' => 'return checarBotonSubmit("btnCotizacionArmadoStore")', 'class' => 'col-sm-6 float-right']) !!}
  <div class="form-group row">
    <label for="armados" class="col-sm-2 col-form-label">{{ __('Agregar') }} *</label>
    <div class="col-sm-10">
      <div class="input-group-append">
        {!! Form::select('id_armado', $armados_list, null, ['class' => 'form-control form-control-sm w-100 select2' . ($errors->has('id_armado') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
        &nbsp&nbsp&nbsp<button type="submit" id="btnCotizacionArmadoStore" class="btn btn-info rounded" title="{{ __('Agregar') }}"><i class="fas fa-check-circle text-dark"></i></button>
      </div>
      <span class="text-danger">{{ $errors->first('id_armado') }}</span>
    </div>
  </div>
{!! Form::close() !!}