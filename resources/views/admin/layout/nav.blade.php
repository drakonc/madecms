<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="collapse navbar-collapse d-flex">
        <ul class="navbar-nav w-100">
            <li class="navbar-item">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-home"></i> MADECMS
                </a>
            </li>
        </ul>
        <ul class="navbar-nav flex-shrink-1 flext-text">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(is_null(Auth::user()->avatar))
                        <img src="{{ url('/static/images/Default_Avatar.png') }}"/>
                    @else
                        <img src="{{ url('/uploads_users/'.Auth::id().'/'.Auth::user()->avatar) }}" class="menu_logo">
                    @endif
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="{{ url('/admin/user/'.Auth::user()->id.'/edit') }}" @if(!kvfj(Auth::user()->permissions,'user_edit')) hidden @endif><i class="fas fa-user-friends"></i> Perfil</a>
                    <a class="dropdown-item" href="{{url('/logout')}}"><i class="fas fa-sign-out-alt"></i> Salir</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
