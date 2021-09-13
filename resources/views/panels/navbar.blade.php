<nav class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ ($configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType']  === 'navbar-floating') ? 'container-xxl' : '' }}">
  <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav">
          <li class="nav-item d-none d-lg-block">
            <div class="bookmark-input search-input">
              <div class="bookmark-input-icon">
                <i data-feather="search"></i>
              </div>
              <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
              <ul class="search-list search-list-bookmark"></ul>
            </div>
          </li>
        </ul>
      </div>
      <ul class="nav navbar-nav align-items-center ms-auto">
        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="{{($configData['theme'] === 'dark') ? 'sun' : 'moon' }}"></i></a></li>
      </li>
      <li class="nav-item dropdown dropdown-user">
        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true">
          <div class="user-nav d-sm-flex d-none">
            <span class="user-name fw-bolder">{{Auth::user()->fullname}}</span>
            @if(Auth::user()->admin == 1)
              <span class="user-status">Admin</span>
            @endif
          </div>
          <span class="avatar">
            <img class="round" src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="40" width="40">
            <span class="avatar-status-online"></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
          <a class="dropdown-item" href="{{route('profile')}}">
            <i class="me-50" data-feather="user"></i> Perfil
          </a>
          <form method="POST" class="pr-3 mr-3" action="{{ route('logout') }}">
            @csrf
            <a class="dropdown-item mb-0 float-start" href="{{ route('logout') }}" onclick="event.preventDefault();
                      this.closest('form').submit();">
                <i class="mr-50" data-feather="power"></i> Cerrar sesion
            </a>
        </form>
        </div>
      </li>
    </ul>
  </div>
</nav>