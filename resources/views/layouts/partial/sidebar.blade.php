<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('backend/dist/img/logo-pedidos.jpg') }}" alt="Logo Seguimiento de Pedidos" style="opacity:.8; width:250px; height:auto; ">
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Panel De Control</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('clientes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Clientes</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('pedidos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Pedidos</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('entregas.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Entregas</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('historial.general') }}" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Historial de Estados</p>
                    </a>
                </li>
                
            </ul>
        </nav>
    </div>
</aside>