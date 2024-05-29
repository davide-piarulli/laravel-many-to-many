<!-- LEFT SIDEBAR -->
<aside class="sidebar d-flex flex-column justify-content-between  flex-shrink-0  text-white h-100 ">

  <!-- top sidebar -->
  <div>
    <ul class="nav nav-pills flex-column mt-2 ">
      <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link text-white">
          <i class="fa-solid fa-house"></i>
          <span class="d-none d-lg-inline-block">Home</span>
          <a>
      </li>
      <li>
        <a href="{{ route('admin.home') }}" class="nav-link text-white">
          <i class="fa-solid fa-chart-simple"></i>
          <span class="d-none d-lg-inline-block">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.projects.index') }}" class="nav-link text-white">
          <i class="fa-solid fa-signal"></i>
          <span class="d-none d-lg-inline-block">Progetti</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.types.index') }}" class="nav-link text-white">
          <i class="fa-solid fa-signal"></i>
          <span class="d-none d-lg-inline-block">Tipi</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.technologies.index') }}" class="nav-link text-white">
          <i class="fa-solid fa-signal"></i>
          <span class="d-none d-lg-inline-block">Tecnologie</span>
        </a>
      </li>
    </ul>
  </div>

  <!-- bottom sidebar -->
  <div>
    <ul class="nav nav-pills flex-column mb-3">

      <li class="nav-item">
        <a href="{{ route('profile.edit') }}" class="nav-link text-white">
          <i class="fa-solid fa-gear"></i>
          <span class="d-none d-lg-inline-block">Ciao {{ Auth::user()->name }}</span>
        </a>
      </li>
      <li class="align-self-center ">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button class="btn btn-danger" type="submit">LOGOUT</button>
        </form>
      </li>
    </ul>
  </div>

</aside>
<!-- / LEFT SIDEBAR -->
