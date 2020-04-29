<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 25em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($armados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr >
          @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.#')
          @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.estatus')
          @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.cantidad')
          @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.regalo')
          @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.autorizado')
          @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.tipo')
          @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.armado')
          @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.tipoDeTarjeta')
          @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.th.direcciones')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($armados as $armado)
          <tr title="{{ $armado->cod }}">
            @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.#')
            @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.estatus')
            @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.cantidad')
            @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.regalo')
            @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.autorizado')
            @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.tipo')
            @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.armado')
            @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.tipoDeTarjeta')
            @include('venta.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_table.td.direcciones')
            @include('venta.pedido_activo.armado_pedidoActivo.vev_arm_pedAct_tableOpciones')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>