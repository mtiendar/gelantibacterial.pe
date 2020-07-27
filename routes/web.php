<?php
Route::group(['middleware' => ['navegador', 'headerSeguro']], function() {
  require_once __DIR__ . '/public/authRoutes.php';

  Route::match(['GET', 'HEAD'],'solicitar/soporte','TecnologiaDeLaInformacion\SoporteController@create')->name('soporte.create');
  Route::post('almacenar', 'TecnologiaDeLaInformacion\SoporteController@store')->name('soporte.store');
  
  Route::get('/offline', function() {
    return view('vendor.laravelpwa.offline');
  });
  
  Route::group(['middleware' => ['sinAccesoAlSistema', 'auth', 'idiomaSistema', 'primerAcceso']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::group(['middleware' => ['rolCliente']], function() {
      Route::get('prueba', function() {
        return 'exito';
      });
    });

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs.index')->middleware('permission:logs.index');
    require_once __DIR__ . '/layouts/layoutsRoutes.php';
    require_once __DIR__ . '/usuario/usuarioRoutes.php';
    require_once __DIR__ . '/quejasYSugerencias/quejasYSugerenciasRoutes.php';
    require_once __DIR__ . '/cliente/clienteRoutes.php';
    require_once __DIR__ . '/papeleraDeReciclaje/papeleraDeReciclajeRoutes.php';
    require_once __DIR__ . '/proveedor/proveedorRoutes.php';
    require_once __DIR__ . '/armado/armadoRoutes.php';
    require_once __DIR__ . '/costoDeEnvio/costoDeEnvioRoutes.php';
    require_once __DIR__ . '/cotizacion/cotizacionRoutes.php';
    require_once __DIR__ . '/factura/facturaRoutes.php';

    Route::group(['prefix' => 'pago'], function() {
      require_once __DIR__ . '/pago/pagoFPedidoRoutes.php';
      require_once __DIR__ . '/pago/pagoIndividualRoutes.php';
    });

    Route::group(['prefix' => 'ti'], function(){
      require_once __DIR__ . '/tecnologiaDeLaInformacion/soporteRoutes.php';
    });
    
    Route::group(['prefix' => 'rastrea'], function() {
      require_once __DIR__ . '/rastrea/rastreaPedidoRoutes.php';
    });
    
    Route::group(['prefix' => 'perfil'], function() {
      require_once __DIR__ . '/perfil/perfilRoutes.php';
      require_once __DIR__ . '/perfil/notificacionRoutes.php';
      require_once __DIR__ . '/perfil/archivoGeneradoRoutes.php';
      require_once __DIR__ . '/perfil/recordatorioRoutes.php';
    });

    Route::group(['prefix' => 'sistema'], function() {
      require_once __DIR__ . '/sistema/sistemaRoutes.php';
      require_once __DIR__ . '/sistema/plantillaRoutes.php';
      require_once __DIR__ . '/sistema/notificacionRoutes.php';
      require_once __DIR__ . '/sistema/actividadRoutes.php';
      require_once __DIR__ . '/sistema/catalogoRoutes.php';
      require_once __DIR__ . '/sistema/serieRoutes.php';
    });

    Route::group(['prefix' => 'rol'], function() {
      require_once __DIR__ . '/rol/rolRoutes.php';
      require_once __DIR__ . '/rol/permisoRoutes.php';
    });

    Route::group(['prefix' => 'venta'], function() {
      require_once __DIR__ . '/venta/ventaRoutes.php';
      require_once __DIR__ . '/venta/pedidoActivoRoutes.php';
      require_once __DIR__ . '/venta/pedidoTerminadoRoutes.php';
    });

    Route::group(['prefix' => 'almacen'], function() {
      require_once __DIR__ . '/almacen/almacenRoutes.php';
      require_once __DIR__ . '/almacen/pedidoActivoRoutes.php';
      require_once __DIR__ . '/almacen/pedidoTerminadoRoutes.php';
      require_once __DIR__ . '/almacen/productoRoutes.php';
    });

    Route::group(['prefix' => 'produccion'], function() {
      require_once __DIR__ . '/produccion/produccionRoutes.php';
      require_once __DIR__ . '/produccion/pedidoActivoRoutes.php';
      require_once __DIR__ . '/produccion/pedidoTerminadoRoutes.php';
    });

    Route::group(['prefix' => 'logistica'], function() {
      require_once __DIR__ . '/logistica/logisticaRoutes.php';
      require_once __DIR__ . '/logistica/pedidoActivoRoutes.php';

      Route::group(['prefix' => 'direccion'], function() {
        Route::match(['GET', 'HEAD'],'metodo-de-entrega-espescifico/{id_metodo_de_entrega}', 'Logistica\DireccionLocal\DireccionLocalController@metodoDeEntregaEspecifico')->name('logistica.metodoDeEntregaEspecifico')->middleware('permission:logistica.direccionLocal.create|logistica.direccionForaneo.create');
        Route::match(['GET', 'HEAD'],'generar-comprobante-de-entrega/{id_direccion}/{for_loc}', 'Logistica\DireccionLocal\DireccionLocalController@generarComprobanteDeEntrega')->name('logistica.direccion.generarComprobanteDeEntrega')->middleware('permission:logistica.direccionLocal.index|logistica.direccionForaneo.index');
        require_once __DIR__ . '/logistica/direccionLocalRoutes.php';
        require_once __DIR__ . '/logistica/direccionForaneaRoutes.php';
      });
      
      require_once __DIR__ . '/logistica/pedidoEntregadoRoutes.php';
    });
  });
});