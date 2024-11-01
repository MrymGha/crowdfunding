<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/mainLogo.png') }}" alt="" style="width: 180px">
        </a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                
                @auth
                <li class="nav-item">
                    {{-- <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="#"> --}}
                        @if (Auth::user()->role == 'admin')
                            <a class="nav-link " href="{{ route('admin.dashboard') }}">Dashboard</a>
                        @elseif (Auth::user()->role == 'project_owner')
                            <a class="nav-link " href="{{ route('project_owner.dashboard') }}">Dashboard</a>
                        @elseif (Auth::user()->role == 'contributor')
                            <a class="nav-link " href="{{ route('contributor.dashboard') }}">Dashboard</a>
                        @endif
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <div class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">{{ __('About') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('campaigns') }}">{{ __('Campaigns') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">{{ __('Contact') }}</a>
                    </li>
                </div>

                <!-- Login/Register Links -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
