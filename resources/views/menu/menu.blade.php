<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ $segment == '' ? 'active' : '' }}" aria-current="page"
                        href="{{ url('/') }}">Home</a>
                </li>

                @can('role-list')
                    <li class="nav-item">
                        <a class="nav-link {{ $segment == 'roles' ? 'active' : '' }}" aria-current="page"
                            href="{{ route('roles.index') }}">Roles</a>
                    </li>
                @endcan

                @can('nasabah-list')
                    <li class="nav-item">
                        <a class="nav-link {{ $segment == 'nasabah' ? 'active' : '' }}" aria-current="page"
                            href="{{ route('nasabah.index') }}">Nasabah</a>
                    </li>
                @endcan

                @if (Gate::check('list-emergency-contact') || Gate::check('list-suami-isti'))
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Detail Nasabah
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @can('list-suami-isti')
                                <li><a class="dropdown-item" href="#">Suami Istri</a></li>
                            @endcan

                            @can('list-emergency-contact')
                                <li><a class="dropdown-item" href="#">Emergency Contact</a></li>
                            @endcan
                        </ul>
                    </li>
                @endif


                @can('list-permohonan')
                    <li class="nav-item">
                        <a class="nav-link" href="#">Permohonan Pinjaman</a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</nav>
