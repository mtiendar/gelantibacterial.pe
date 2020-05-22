<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 21em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($archivos) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <tbody> 
        @foreach($archivos as $archivo)
          <tr title="{{ $archivo->arch_nom }}">
            <td>
              <a href="{{ Storage::url($archivo->arch_rut.$archivo->arch_nom) }}" download>{{ $archivo->arch_nom }}</a>
            </td>
          </tr>
          @endforeach
      </tbody>
    @endif
  </table>
</div>