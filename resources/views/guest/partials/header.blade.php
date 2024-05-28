<header>

  <nav class="navbar navbar-expand-lg bg-body-secondary">
    <div class="container-fluid d-flex ">

      <div class="collapse navbar-collapse w-100" id="navbarNav">
        <div class="menu-left w-75 ">
          <ul class="navbar-nav">

            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
            </li>

          </ul>
        </div>
        <div class="menu-right justify-content-end align-content-end ">
          <ul class="navbar-nav">

            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{ route('login') }}">Sign in</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{ route('register') }}">Sign up</a>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </nav>

</header>
