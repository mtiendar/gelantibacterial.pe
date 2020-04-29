@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Detalles catálogo'))</title>
<div class="card card-info card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-botton">
    <h5>
      <strong>{{ __('Detalles del registro') }}:</strong>
      @can('sistema.catalogo.edit')
        <a href="{{ route('sistema.catalogo.edit', Crypt::encrypt($catalogo->id)) }}">{{ $catalogo->vista }}</a>
      @else
        {{ $catalogo->vista }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon bg-info">
      <small>{{ $catalogo->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('sistema.catalogo.sis_cat_showFields')
  </div>
</div>
@endsection