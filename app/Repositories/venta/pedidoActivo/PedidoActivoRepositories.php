<?php
namespace App\Repositories\venta\pedidoActivo;
// Models
use App\Models\Pedido;
// Events
use App\Events\layouts\ActividadRegistrada;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class PedidoActivoRepositories implements PedidoActivoInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
  } 
  public function pedidoAsignadoFindOrFailById($id_pedido, $relaciones) { // 'usuario', 'unificar', 'armados', 'pago'
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with($relaciones)->where('estat_log', '!=', config('app.entregado'))->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->findOrFail($id_pedido);
    return $pedido;
  }
  public function getPagination($request, $relaciones) { // 'usuario', 'unificar'
    return Pedido::with($relaciones)->where('estat_log', '!=', config('app.entregado'))->asignado(Auth::user()->registros_tab_acces, Auth::user()->email_registro)->buscar($request->opcion_buscador, $request->buscador)->orderBy('id', 'DESC')->paginate($request->paginador);
  }
  public function update($request, $id_pedido) {
    try { DB::beginTransaction();
      $pedido = $this->pedidoAsignadoFindOrFailById($id_pedido, ['armados']);
      $pedido->fech_de_entreg     = $request->fecha_de_entrega;
      $pedido->se_pued_entreg_ant = $request->se_puede_entregar_antes;
      if($pedido->se_pued_entreg_ant == 'Si') {
        $pedido->cuant_dia_ant    = $request->cuantos_dias_antes;
      } elseif($pedido->se_pued_entreg_ant == 'No') {
        $pedido->cuant_dia_ant    = null;
      }
      $pedido->urg                = $request->es_pedido_urgente;
      $pedido->coment_vent        = $request->comentarios_ventas;
      if($pedido->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Ventas (Pedidos activos)', // Módulo
          'venta.pedidoActivo.show', // Nombre de la ruta
          $id_pedido, // Id del registro debe ir encriptado
          $pedido->serie, // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Fecha de entrega', '¿Se puede entregar antes?', '¿Cuántos días antes?', '¿Es pedido urgente?', 'Comentarios ventas'), // Nombre de los inputs del formulario
          $pedido, // Request
          array('fech_de_entreg', 'se_pued_entreg_ant', 'cuant_dia_ant', 'urg', 'coment_vent') // Nombre de los campos en la BD
        ); 
        $pedido->updated_at_ped  = Auth::user()->email_registro;
      }
      $fecha_original = $pedido->getOriginal('fech_de_entreg');
      $fecha_nueva    = $pedido->getAttribute('fech_de_entreg');
      $pedido->save();
      Pedido::getEstatusVentas($pedido);
      $this->unificarPedido($pedido, $fecha_original, $fecha_nueva);
      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function destroy($id_pedido) {
    try { DB::beginTransaction();
      $pedido = $this->pedidoAsignadoFindOrFailById($id_pedido, []);
      $pedido->delete();
      // EN AUTOMATICO ELIMINA LA UNIFICACION QUE TIENE CON LOS DEMAS PEDIDOS

      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Ventas pedido activo', // Nombre del módulo del sistema
        'registro'    => $pedido->num_pedido, // Información a mostrar en la papelera
        'tab'         => 'pedidos', // Nombre de la tabla en la BD
        'id_reg'      => $pedido->id, // ID de registro eliminado
        'id_fk'       => null // ID de la llave foranea con la que tiene relación           
      ]);

      DB::commit();
      return $pedido;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function getArmadosPedidoPagination($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->armados()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->armados()->paginate($request->paginador);
  }
  public function getMontoDePagosAprobados($pedido) {
    return $pedido->pagos()->where('estat_pag', config('app.aprobado'))->sum('mont_de_pag');
  }
  public function getPagosPedidoPagination($pedido, $request) {
    if($request->opcion_buscador != null) {
      return $pedido->pagos()->where("$request->opcion_buscador", 'LIKE', "%$request->buscador%")->paginate($request->paginador);
    }
    return $pedido->pagos()->paginate($request->paginador);
  }
  public function getPedidoFindOrFail($id_pedido, $relaciones) {// 'armados', 'unificar'
    $id_pedido = $this->serviceCrypt->decrypt($id_pedido);
    $pedido = Pedido::with($relaciones)->findOrFail($id_pedido);
    return $pedido;
  }
  public function getEstatusPagoPedido($pedido) {
    $pagos_rechazado      = $pedido->pagos()->where('estat_pag', config('app.rechazado'))->get();
    $pagos_pendientes     = $pedido->pagos()->where('estat_pag', config('app.pendiente'))->get();
    $sum_pagos_aprobados  = $pedido->pagos()->where('estat_pag', config('app.aprobado'))->sum('mont_de_pag');
    
    $count_pagos_rechazado  = count($pagos_rechazado);
    $count_pagos_pendientes = count($pagos_pendientes);

    // ESTATUS PENDIENTE
    if($count_pagos_pendientes == 0) {
      $pedido->estat_pag = config('app.pendiente');
    }

    // ESTATUS PENDIENTE DE APROBAR
    if($count_pagos_pendientes > 0) {
      $pedido->estat_pag = config('app.pago_pendiente_de_aprobar');
    }

    // ESTATUS RECHAZADO
    if($count_pagos_rechazado > 0) {
      $pedido->estat_pag = config('app.pago_rechazado');
    }

    // ESTATUS PAGADO
    if($sum_pagos_aprobados == $pedido->mont_tot_de_ped) {
      $pedido->estat_pag = config('app.pagado');
    }
    $pedido->save();
  }
  public function unificarPedido($pedido, $fecha_original, $fecha_nueva) {
    if($fecha_original != $fecha_nueva) {
      $this->eliminarUnificacionDelPedido($pedido->id);
    }
    $pedidos_a_unificar = Pedido::with('unificar')->where('fech_de_entreg', $pedido->fech_de_entreg)->where('user_id', $pedido->user_id)->where('id', '!=', $pedido->id)->orderby('serie', 'DESC')->get();
    $num_pedidos_a_unificar = count($pedidos_a_unificar);
    if($num_pedidos_a_unificar > 0) { 
      $hastaC = $num_pedidos_a_unificar - 1;

      // Agrupa todos los ids que tienen relacion en la misma fecha de entrega y mismo cliente
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $ids_pedidos[$pedidos_a_unificar[$contador2]->id] = $pedidos_a_unificar[$contador2]->id;
      }
      $pedido->unificar()->sync($ids_pedidos); // Elimina toda relación con los pedidos

      // Crea la relación de los demas pédidos con el pedido que esta ejecutando la función
      $ids_pedidos[$pedido->id] = $pedido->id;
      $nuev_ids_pedidos  = $ids_pedidos;
      for($contador3 = 0; $contador3 <= $hastaC; $contador3++) {
        $ids_pedidos_menos = $nuev_ids_pedidos;
        unset($ids_pedidos_menos[$pedidos_a_unificar[$contador3]->id]);
        $pedidos_a_unificar[$contador3]->unificar()->sync($ids_pedidos_menos);
      }
    }
  }
  public function eliminarUnificacionDelPedido($id_pedido) {
    $pedido = $this->getPedidoFindOrFail($this->serviceCrypt->encrypt($id_pedido), ['unificar']);
    $pedidos_a_eliminar_unificacion = $pedido->unificar;
    $num_pedidos_a_eliminar_unificacion = count($pedidos_a_eliminar_unificacion);

    if($num_pedidos_a_eliminar_unificacion > 0) { 
      // Agrupa todos los ids que tiene relación con el pedido menos el id del pedido que esta ejecutando la función
      $hastaC = $num_pedidos_a_eliminar_unificacion - 1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $ids_pedidos[$contador2] = $pedidos_a_eliminar_unificacion[$contador2]->id;
      }
      $pedido->unificar()->detach($ids_pedidos);
      
      // Elimina la relación de los demas pédidos con el pedido que esta ejecutando la función
      $ids_pedidos[$pedido->id] = $pedido->id;
      for($contador3 = 0; $contador3 <= $hastaC; $contador3++) {
        $pedidos_a_eliminar_unificacion[$contador3]->unificar()->detach($pedido->id);
      }
    }
  }
}