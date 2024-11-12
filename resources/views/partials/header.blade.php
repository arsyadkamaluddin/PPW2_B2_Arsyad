<nav class="navbar navbar-expand-lg bg-Light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-labels="toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav as-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('register') ? 'active' : '' }}"
                            href="{{ route('register') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('books.index') ? 'active' : '' }}"
                            href="{{ route('books.index') }}">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('books.index') ? 'active' : '' }}"
                            href="{{ route('photos.index') }}">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('logout') }}">Logout</a>
                    </li>
                    
                @endguest
            </ul>
        </div>
    </div>
</nav>
