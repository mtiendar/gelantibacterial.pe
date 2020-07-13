<td width="1rem" title="Registrar comprobante de salida: {{ $direccion->est }}">
  @if($direccion->estat != config('app.pendiente') AND $direccion->estat != config('app.entregado'))
    @can('logistica.direccionLocal.createComprobantes')
      <a href="{{ route('logistica.direccionLocal.createComprobanteDeSalida', Crypt::encrypt($direccion->id)) }}" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-sign-out-alt"></i></a>
    @endcan
  @endif
</td>
<td width="1rem" title="Registrar comprobante de entrega: {{ $direccion->est }}">
  @if($direccion->estat != config('app.pendiente') AND $direccion->estat != config('app.entregado'))
    @can('logistica.direccionLocal.createComprobantes')
      <a href="" class='btn btn-light btn-sm' target="_blank"><i class="fas fa-truck"></i></a>
    @endcan
  @endif
</td>