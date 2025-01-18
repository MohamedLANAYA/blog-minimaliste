<nav class="navbar navbar-expand-lg " style="background-color: #007ea7 ">
    <div class="container-fluid">
        <!-- Logo or site name -->
        <a class="navbar-brand" href="{{ url('/') }}">Blog Minimaliste</a>

        <!-- Button for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Main menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Link to Articles -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.index') }}">Articles</a>
                </li>

                <!-- Link to Categories -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">Catégories</a>
                </li>

                <!-- Additional links for admins -->
                @auth
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('articles.create') }}">Ajouter un Article</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.create') }}">Ajouter une Catégorie</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Login / Logout buttons -->
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-green btn-sm me-2">
                            <i class="fas fa-sign-in-alt"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-outline-green btn-sm me-2">
                            <i class="fas fa-user-plus"></i> Inscription
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
