<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="imagen_del_producto">{{ __('Imagen del producto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
     <div class="custom-file"> 
        {!! Form::file('imagen_del_producto', ['id' => 'imagen_del_producto', 'class' => 'custom-file-input', 'onclick' => 'visualizarImagen("imagen_del_producto", "visualizar-imagen_del_producto")', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
      <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
    </div>
    <span class="text-danger">{{ $errors->first('imagen_del_producto') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <center>
      <figure>
        <div id="visualizar-imagen_del_producto"></div>
      </figure>
    </center>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_producto">{{ __('Nombre del producto') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('nombre_del_producto', null, ['class' => 'form-control' . ($errors->has('nombre_del_producto') ? ' is-invalid' : ''), 'maxlength' => 70, 'placeholder' => __('Nombre del producto')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_del_producto') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="sku">{{ __('SKU') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
      </div>
      {!! Form::text('sku', null, ['class' => 'form-control' . ($errors->has('sku') ? ' is-invalid' : ''), 'maxlength' => 30, 'placeholder' => __('SKU')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('sku') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="marca">{{ __('Marca') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('marca', null, ['class' => 'form-control' . ($errors->has('marca') ? ' is-invalid' : ''), 'maxlength' => 70, 'placeholder' => __('Marca')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('marca') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="tipo">{{ __('Tipo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo', config('opcionesSelect.select_tipo'), null, ['id' => 'tipo', 'class' => 'form-control select2' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'getTipo();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo') }}</span>
  </div>
</div>
<div id="medidas">
  <label for="redes_sociales">{{ __('MEDIDAS') }}</label>
  <div class="border border-primary rounded p-2">
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="alto">{{ __('Alto') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
          </div>
          {!! Form::text('alto', null, ['id' => 'alto', 'class' => 'form-control' . ($errors->has('alto') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Alto'), 'onChange' => 'getAlto();']) !!}
          <div class="input-group-prepend">
            <span class="input-group-text">cm</span>
          </div>
        </div>
        <span class="text-danger">{{ $errors->first('alto') }}</span>
      </div>
      <div class="form-group col-sm btn-sm">
        <label for="ancho">{{ __('Ancho') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
          </div>
          {!! Form::text('ancho', null, ['id' => 'ancho', 'class' => 'form-control' . ($errors->has('ancho') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Ancho'), 'onChange' => 'getAncho();']) !!}
          <div class="input-group-prepend">
            <span class="input-group-text">cm</span>
          </div>
        </div>
        <span class="text-danger">{{ $errors->first('ancho') }}</span>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="largo">{{ __('Largo') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
          </div>
          {!! Form::text('largo', null, ['id' => 'largo', 'class' => 'form-control' . ($errors->has('largo') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Largo'), 'onChange' => 'getLargo();']) !!}
          <div class="input-group-prepend">
            <span class="input-group-text">cm</span>
          </div>
        </div>
        <span class="text-danger">{{ $errors->first('largo') }}</span>
      </div>
      <div class="form-group col-sm btn-sm">
        <label for="costo_de_armado">{{ __('Costo de armado') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
          </div>
          {!! Form::text('costo_de_armado', null, ['id' => 'costo_de_armado', 'class' => 'form-control' . ($errors->has('costo_de_armado') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Costo de armado'), 'onChange' => 'getTipo();']) !!}
          <div class="input-group-append">
            <span class="input-group-text">.00</span>
          </div>
        </div>
        <span class="text-danger">{{ $errors->first('costo_de_armado') }}</span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="categoria">{{ __('Categoría') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar catálogo') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('categoria', $categorias_list, null, ['class' => 'form-control select2' . ($errors->has('categoria') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('categoria') }}</span>
  </div>
  <div class="form-group col-sm-6 btn-sm">
    <label for="etiqueta">{{ __('Etiqueta') }} *</label>
    @can('sistema.catalogo.create')
      <a href="{{ route('sistema.catalogo.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar catálogo') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('etiqueta', $etiquetas_list, null, ['class' => 'form-control select2' . ($errors->has('etiqueta') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('etiqueta') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="peso">{{ __('Peso') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-weight"></i></span>
      </div>
      {!! Form::text('peso', null, ['id' => 'peso', 'class' => 'form-control' . ($errors->has('peso') ? ' is-invalid' : ''), 'maxlength' => 7, 'placeholder' => __('Peso'), 'onChange' => 'getPeso();']) !!}
      <div class="input-group-prepend">
        <span class="input-group-text">Kg</i></span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('peso') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="codigo_de_barras">{{ __('Código de barras') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-barcode"></i></i></span>
      </div>
      {!! Form::text('codigo_de_barras', null, ['class' => 'form-control' . ($errors->has('codigo_de_barras') ? ' is-invalid' : ''), 'maxlength' => 250, 'placeholder' => __('Código de barras')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('codigo_de_barras') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="descripcion_del_producto">{{ __('Descripción del producto') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('descripcion_del_producto', null, ['class' => 'form-control' . ($errors->has('descripcion_del_producto') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Descripción del producto'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('descripcion_del_producto') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('almacen.producto.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@include('almacen.producto.alm_pro_getDecimal')
@section('js6')
<script>
  window.onload = function() { 
    getTipo();
  }
  function getTipo() {
    // Obtiene los valores de los inputs
    selectTipo = document.getElementById("tipo"),
    tipo = selectTipo.value;
    medidas = document.getElementById('medidas');
    // ---

    // Asigna el valor al input costo de armado dependoendo la seleccion del input tipo
    if(tipo == 'Canasta') {
      medidas.style.display = 'block';
      costo_de_armado = document.getElementById("costo_de_armado").value;
      if (isNaN(parseFloat(costo_de_armado))) {
        costo_de_armado = 0;
      }
    } else if(tipo == 'Producto' || tipo == '') {
      medidas.style.display = 'none';
      costo_de_armado = 0;
    }
    // ---
    
    // Agrega o solo deja dos decimales
    costo_de_armado_decimal   = Number.parseFloat(costo_de_armado).toFixed(2);
    // ---
  
    // Pega el resultado en los inputs
    if(tipo == 'Canasta') {
      document.getElementById("costo_de_armado").value = costo_de_armado_decimal;
    }
  }
</script>
@endsection