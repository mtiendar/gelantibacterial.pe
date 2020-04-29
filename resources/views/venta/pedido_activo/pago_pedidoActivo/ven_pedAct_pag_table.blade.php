<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 20em;"> 
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($pagos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr> 
          @include('pago.pag_table.th.#')
          @include('pago.pag_table.th.estatusPago')
          @include('pago.pag_table.th.tipo')
          @include('pago.pag_table.th.formaDePago')
          @include('pago.pag_table.th.montoDePago')
          <th colspan="2">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($pagos as $pago)
          <tr title="{{ $pago->id }}">
            @include('venta.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_tableOpcionShow')
            @include('pago.pag_table.td.estatusPago')
            @include('pago.pag_table.td.tipo')
            @include('pago.pag_table.td.formaDePago')
            @include('pago.pag_table.td.montoDePago')
            @include('venta.pedido_activo.pago_pedidoActivo.ven_pedAct_pag_tableOpciones')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>