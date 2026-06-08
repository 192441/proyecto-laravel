<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <div class="user-panel mt-2 pb-3 d-flex">

            <div class="image">

                @php
                    // Ruta de la foto del usuario
                    $userPhotoPath = 'uploads/users/foto_eduardo.jpg';
                @endphp

                @if(auth()->check())

                    @if (file_exists(public_path($userPhotoPath)))
                        <img class="img-circle elevation-2"
                             src="{{ asset($userPhotoPath) }}"
                             alt="{{ auth()->user()->name }}"
                             style="width: 40px; height: 40px; object-fit: cover;">
                    @else
                        <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}"
                             class="img-circle elevation-2"
                             alt="Usuario">
                    @endif

                @else

                    <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}"
                         class="img-circle elevation-2"
                         alt="Invitado">

                @endif

            </div>

            <div class="info" style="color:#6c757d">

                @if(auth()->check())
                    {{ auth()->user()->name }}
                @else
                    Invitado
                @endif

            </div>

        </div>

        @if(auth()->check())
            <li class="nav-item">

                <a class="nav-link"
                   href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                   title="Cerrar Sesión"
                   role="button">

                    <i class='fas fa-power-off'
                       style='font-size:24px; color:red'></i>

                </a>

                <form id="logout-form"
                      method="POST"
                      action="{{ route('logout') }}"
                      style="display: none">

                    @csrf

                </form>

            </li>
        @endif

    </ul>

</nav>