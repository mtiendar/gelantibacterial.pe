@canany(['soporte.index', 'soporte.create', 'soporte.show', 'soporte.edit', 'soporte.destroy'])
  <li class="nav-item">
    <a href="{{ route('soporte.index') }}" class="nav-link {{ Request::is('ti/soporte') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de soportes') }}
    </a>
  </li>
@endcanany