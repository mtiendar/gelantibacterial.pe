@extends('layouts.private.escritorio.dashboard')
@section('titulo')
<div class="col-sm-6">
  <h1 class="m-0 text-dark"> {{ $cliente->nom.' '.$cliente->apell }}</h1>
</div>
@endsection
@section('contenido')
<title>@section('title', __('Lista de direcciones').' | '.$cliente->nom)</title>
@include('cliente.show.cli_sho_menu')
@can('cliente.edit')
  @include('cliente.show.direccion.sho_dir_create')
@endcan
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-body">
    <div class="pb-1">
      {!! Form::model(Request::all(), ['route' => ['cliente.show.direccion.index', Crypt::encrypt($cliente->id)], 'method' => 'GET']) !!}
      <div style="float: right;">
        <div class="input-group input-group-sm" style="width: 25em;">
          {!! Form::select('opcion_buscador', config('opcionesSelect.select_direcciones_index'), null, ['class' => 'form-control float-right']) !!}
          {!! Form::text('buscador', null, ['class' => 'form-control float-right', 'placeholder' => __('Buscador'), 'title' => __('Enter para buscar')]) !!} 
          <div class="input-group-append">
            <button type="submit" class="btn btn-default" title="{{ __('Buscar') }}"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>
      <div class="input-group input-group-sm" style="width: 13em;">
        {{ __('Mostrar') }} 
        &nbsp{!! Form::select('paginador', ['15' => '15', '30' => '30', '50' => '50'], null, ['class' => 'form-control btn-sm w-25', 'onchange' => 'this.form.submit()']) !!}&nbsp 
        {{ __('registros') }}.
        <span class="text-danger">{{ $errors->first('paginador') }}</span>
      </div>
      {!! Form::close() !!}
    </div>
    @include('cliente.show.direccion.sho_dir_table')
    <div class="pt-2">
      <div style="float: right;">
        {!! $direcciones->appends(Request::all())->links() !!}  
      </div>
      {{ __('Mostrando desde') . ' '. $direcciones->firstItem() . ' ' . __('hasta') . ' '. $direcciones->lastItem() . ' ' . __('de') . ' '. $direcciones->total() . ' ' . __('registros') }}.
    </div> 
  </div>
</div>
@endsection