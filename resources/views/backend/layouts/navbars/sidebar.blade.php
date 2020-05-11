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

        <li class="nav-item {{ $activePage == 'messages.panel' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('messages.panel') }}">
                <i class="material-icons">android</i>
                <p> Messages</p>
            </a>
        </li>

        <li class="nav-item {{ $activePage == 'sections.slider' || $activePage == 'sections.upcoming' || $activePage == 'sections.projects' || $activePage == 'sections.contact' || $activePage == 'sections.about' ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#SectionGroupMenu" aria-expanded="{{ $activePage == 'sections.navbar' || $activePage == 'sections.slider' || $activePage == 'sections.upcoming' || $activePage == 'sections.projects' || $activePage == 'sections.contact' || $activePage == 'sections.about' ? 'true' : 'false' }}">
                <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                <p>Sections
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse {{ $activePage == 'sections.navbar' || $activePage == 'sections.slider' || $activePage == 'sections.upcoming' || $activePage == 'sections.projects' || $activePage == 'sections.contact' || $activePage == 'sections.about' ? 'show' : '' }}" id="SectionGroupMenu">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'sections.navbar' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('sections.navbar') }}">
                            <span class="sidebar-mini"> HS </span>
                            <span class="sidebar-normal">{{ __('Navbar') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'sections.slider' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('sections.sliders') }}">
                            <span class="sidebar-mini"> HS </span>
                            <span class="sidebar-normal">{{ __('Home Slider') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'sections.upcoming' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('sections.upcoming') }}">
                            <span class="sidebar-mini"> Up </span>
                            <span class="sidebar-normal">{{ __('Upcoming') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'sections.projects' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('sections.projects') }}">
                            <span class="sidebar-mini"> Pr </span>
                            <span class="sidebar-normal">{{ __('Projects') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'sections.gallery*' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('sections.gallery') }}">
                            <span class="sidebar-mini"> G </span>
                            <span class="sidebar-normal">{{ __('Gallery') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'sections.contact' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('sections.contact') }}">
                            <span class="sidebar-mini"> CU </span>
                            <span class="sidebar-normal">{{ __('Contact Us') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'sections.about*' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('sections.about') }}">
                            <span class="sidebar-mini"> AU </span>
                            <span class="sidebar-normal">{{ __('About Us') }} </span>
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
