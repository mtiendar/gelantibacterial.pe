@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Inicio almacén'))</title>
<div class="row">
  @canany(['almacen.pedidoActivo.index'])
    <div class="col-lg-3">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ __('Pedidos almacén') }}</h3>
          <div class="btn-group">
            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('Ver más') }}
            </a>
            <div class="dropdown-menu">
              @canany(['almacen.pedidoActivo.index'])
                <a href="" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos activos') }}</a>
              @endcanany
              @canany(['almacen.pedidoTerminado.index'])
                <a href="" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de pedidos terminados') }}</a>
              @endcanany
            </div>
          </div>
        </div>
        <div class="icon">
          <i class="fas fa-shopping-bag"></i>
        </div>
      </div>
    </div>
  @endcanany
  @canany(['almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.edit', 'almacen.producto.proveedor.destroy'])    
    <div class="col-lg-3">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ __('Productos') }}</h3>
          <div class="btn-group">
            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('Ver más') }}
            </a>
            <div class="dropdown-menu">
              @canany(['almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.edit', 'almacen.producto.proveedor.destroy'])
                <a href="{{ route('almacen.producto.index') }}" class="dropdown-item"><i class="fas fa-list"></i> {{ __('Lista de productos') }}</a>
              @endcanany
              @can('almacen.producto.create')
                <a href="{{ route('almacen.producto.create') }}" class="dropdown-item"><i class="far fa-plus-square"></i> {{ __('Registrar producto') }}</a>
              @endcan
            </div>
          </div>
        </div>
        <div class="icon">
          <i class="fab fa-product-hunt"></i>
        </div>
      </div>
    </div>
  @endcanany
</div>
@endsection