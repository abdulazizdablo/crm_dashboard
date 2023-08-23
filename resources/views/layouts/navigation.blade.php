<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            {{ __('Users') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('clients.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-contact') }}"></use>
            </svg>
            {{ __('Clients') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('projects.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-library') }}"></use>
            </svg>
            {{ __('Projects') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-list') }}"></use>
            </svg>
            {{ __('Tasks') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.active') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-align-left') }}"></use>
            </svg>
            {{ __('Active Users') }}
        </a>
    </li>

    <a class="dropdown-item" href="{{ route('profile.show') }}">
        <svg class="icon me-2">
            <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
        </svg>
        {{ __('My profile') }}
    </a>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('about') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('About us') }}
        </a>
    </li>

    <form style="z-index:99;" method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault(); this.closest('form').submit();">
            <svg class="icon me-2">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
            </svg>
            {{ __('Logout') }}
        </a>
    </form>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Two-level menu
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Child menu
                </a>
            </li>
        </ul>
    </li>
</ul>
