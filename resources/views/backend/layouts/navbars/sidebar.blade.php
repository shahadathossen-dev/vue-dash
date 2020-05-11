<div class="sidebar custom-scrollbar " data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{route('dashboard')}}" class="simple-text logo-normal">
        <img src="{{ asset('frontend')}}/img/logo.png" alt="{{str_replace('-', ' ', config('app.name'))}}" style="max-height: 40px;">
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item {{ $activePage == 'dashboard' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="material-icons">dashboard</i>
                <p>{{ __('Dashboard') }}</p>
            </a>
        </li>
        <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'users.management') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#UserGroupMenu" aria-expanded="{{ ($activePage == 'profile' || $activePage == 'users.management') ? 'true' : 'false' }}">
                <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                <p>User Access
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse {{ ($activePage == 'profile' || $activePage == 'users.management') ? ' show' : '' }}" id="UserGroupMenu">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'users.management' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <span class="sidebar-mini"> UM </span>
                            <span class="sidebar-normal"> {{ __('Users') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.roles.index') }}">
                            <span class="sidebar-mini"> UP </span>
                            <span class="sidebar-normal">{{ __('Roles') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.permissions.index') }}">
                            <span class="sidebar-mini"> UP </span>
                            <span class="sidebar-normal">{{ __('Permissions') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item{{ $activePage == 'company.settings' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('company.settings') }}">
                <i class="material-icons">android</i>
                <p> Company Settings</p>
            </a>
        </li>
    </ul>
  </div>
</div>
