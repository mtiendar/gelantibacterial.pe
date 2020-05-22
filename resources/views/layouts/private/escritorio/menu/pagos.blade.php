@canany(['pago.index'])
  <li class="nav-item has-treeview {{ Request::is('pago*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('pago*') ? 'active' : '' }}">
      <i class="nav-icon far fa-money-bill-alt"></i>
      <p>
        {{ __('Pagos') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['pago.index'])
        <li class="nav-item">
          <a href="{{ route('pago.fPedido.index') }}" class="nav-link {{ Request::is('pago/f-pedido') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de pagos (F. por pedido)') }}</p>
          </a>
        </li>
      @endcanany
      @canany(['pago.index'])
        <li class="nav-item">
          <a href="{{ route('pago.index') }}" class="nav-link {{ Request::is('pago') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de pagos (Individual)') }}</p>
          </a>
        </li>
      @endcanany
    </ul>
  </li>
@endcanany