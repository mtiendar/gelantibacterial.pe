<?php
/* ===================== [ RUTAS PRODUCCIÓN (PEDIDO ACTIVO) ] ===================== */
Route::group(['prefix' => 'pedido-activo'], function() {
  Route::match(['GET', 'HEAD'],'', 'Produccion\PedidoActivo\PedidoActivoController@index')->name('produccion.pedidoActivo.index')->middleware('permission:produccion.pedidoActivo.index|produccion.pedidoActivo.show|produccion.pedidoActivo.edit|produccion.pedidoActivo.armado.show|produccion.pedidoActivo.armado.edit');
  Route::match(['GET', 'HEAD'],'detalles/{id_pedido}', 'Produccion\PedidoActivo\PedidoActivoController@show')->name('produccion.pedidoActivo.show')->middleware('permission:produccion.pedidoActivo.show|produccion.pedidoActivo.armado.show');
  Route::match(['GET', 'HEAD'],'editar/{id_pedido}', 'Produccion\PedidoActivo\PedidoActivoController@edit')->name('produccion.pedidoActivo.edit')->middleware('permission:produccion.pedidoActivo.edit|produccion.pedidoActivo.armado.show|produccion.pedidoActivo.armado.edit');
  Route::match(['PUT', 'PATCH'],'actualizar/{id_pedido}', 'Produccion\PedidoActivo\PedidoActivoController@update')->name('produccion.pedidoActivo.update')->middleware('permission:produccion.pedidoActivo.edit');
  Route::match(['GET', 'HEAD'],'orden-de-produccion/{id_pedido}', 'Produccion\PedidoActivo\PedidoActivoController@generarOrdenDeProduccion')->name('produccion.pedidoActivo.generarOrdenDeProduccion')->middleware('permission:produccion.pedidoActivo.index');
 
  Route::group(['prefix' => 'armado'], function() {
    Route::match(['GET', 'HEAD'],'detalles/{id_armado}', 'Produccion\pedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@show')->name('produccion.pedidoActivo.armado.show')->middleware('permission:produccion.pedidoActivo.armado.show');
    Route::match(['GET', 'HEAD'],'editar/{id_armado}', 'Produccion\pedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@edit')->name('produccion.pedidoActivo.armado.edit')->middleware('permission:produccion.pedidoActivo.armado.edit');
    Route::match(['PUT', 'PATCH'],'actualizar/{id_armado}', 'Produccion\pedidoActivo\ArmadoPedidoActivo\ArmadoPedidoActivoController@update')->name('produccion.pedidoActivo.armado.update')->middleware('permission:produccion.pedidoActivo.armado.edit');
  });
});