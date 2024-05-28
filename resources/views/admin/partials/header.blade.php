<header>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('admin.home') }}">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" target="blank" href="{{ route('home') }}">Visualizza Sito</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('admin.projects.index') }}">Progetti</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profilo</a></li>
              <li><a class="dropdown-item" href="#">Impostazioni</a></li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="btn btn-danger" type="submit">LOGOUT</button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

</header>
