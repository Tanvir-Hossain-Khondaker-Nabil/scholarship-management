<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->

    <div class="app-brand demo">
        <a href="{{url('/')}}" class="app-brand-link">
            <span class="app-brand-logo demo">
                @include('admin._partials.macros',["height"=>20])
            </span>
            <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
        </a>

        <a href="{{ route('admin.dashboard') }}" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }} menu-item">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>                                
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>
        <li
            class="{{ request()->routeIs('classes.index') || request()->routeIs('classes.create') || request()->routeIs('classes.edit') ? 'active open' : '' }} menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon ti ti-school"></i>                
                <div data-i18n="Dashboards">Institute</div>
                <div class="badge bg-label-primary rounded-pill ms-auto">2</div>
            </a>
            <ul class="menu-sub">
                <li class="{{ request()->routeIs('classes.index') ? 'active' : '' }} menu-item">
                    <a href="{{ route('institute.index') }}" class="menu-link">
                        <div>List</div>
                    </a>
                </li>
                <li class="{{ request()->routeIs('classes.create') ? 'active' : '' }} menu-item">
                    <a href="{{ route('institute.create') }}" class="menu-link">
                        <div>Create</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="{{ request()->routeIs('classes.index') || request()->routeIs('classes.create') || request()->routeIs('classes.edit') ? 'active open' : '' }} menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon ti ti-server"></i>
                <div data-i18n="Dashboards">Class</div>
                <div class="badge bg-label-primary rounded-pill ms-auto">2</div>
            </a>
            <ul class="menu-sub">
                <li class="{{ request()->routeIs('classes.index') ? 'active' : '' }} menu-item">
                    <a href="{{ route('classes.index') }}" class="menu-link">
                        <div>List</div>
                    </a>
                </li>
                <li class="{{ request()->routeIs('classes.create') ? 'active' : '' }} menu-item">
                    <a href="{{ route('classes.create') }}" class="menu-link">
                        <div>Create</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="{{ request()->routeIs('classes.index') || request()->routeIs('classes.create') || request()->routeIs('classes.edit') ? 'active open' : '' }} menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                {{-- <i class="menu-icon tf-icons ti ti-briefcase"></i> --}}                
                <i class="menu-icon ti ti-clipboard"></i>
                <div data-i18n="Dashboards">Exam Center</div>
                <div class="badge bg-label-primary rounded-pill ms-auto">2</div>
            </a>
            <ul class="menu-sub">
                <li class="{{ request()->routeIs('classes.index') ? 'active' : '' }} menu-item">
                    <a href="{{ route('examcenter.index') }}" class="menu-link">
                        <div>List</div>
                    </a>
                </li>
                <li class="{{ request()->routeIs('classes.create') ? 'active' : '' }} menu-item">
                    <a href="{{ route('examcenter.create') }}" class="menu-link">
                        <div>Create</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="{{ request()->routeIs('classes.index') || request()->routeIs('classes.create') || request()->routeIs('classes.edit') ? 'active open' : '' }} menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                {{-- <i class="menu-icon tf-icons ti ti-briefcase"></i> --}}                
                <i class="menu-icon ti ti-server"></i>
                <div data-i18n="Dashboards">Registration</div>
                <div class="badge bg-label-primary rounded-pill ms-auto">1</div>
            </a>
            <ul class="menu-sub">
                <li class="{{ request()->routeIs('classes.index') ? 'active' : '' }} menu-item">
                    <a href="{{ route('student.index') }}" class="menu-link">
                        <div>List</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
