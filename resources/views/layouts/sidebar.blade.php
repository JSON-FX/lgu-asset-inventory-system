<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('')</li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="home"></i>
                        {{-- <span class="badge rounded-pill bg-soft-success text-success float-end">+9</span> --}}
                        <span data-key="t-dashboard">@lang('translation.Dashboards')</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="box"></i>
                        <span class="badge rounded-pill bg-soft-danger text-danger float-end"></span>
                        <span data-key="t-forms">@lang('Assets')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('asset') }}" key="t-starter-page">@lang('Assets List')</a></li>
                        <li><a href="{{ route('assetlist.create') }}" key="t-maintenance">@lang('Add Asset')</a></li>
                    </ul>
                    
                </li>
                <li>
                    <a href="{{ route('category.index') }}">
                        <i data-feather="layers"></i>
                        <span data-key="t-authentication">@lang('Category')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('office.index') }}">
                        <i data-feather="trello"></i>
                        <span data-key="t-tasks">@lang('Office')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}">
                        <i data-feather="users"></i>
                        <span data-key="t-contacts">@lang('User')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('status.index') }}">
                        <i data-feather="activity"></i>
                        <span data-key="t-contacts">@lang('Status')</span>
                    </a>
                </li>
                
               
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">@lang('Reports')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('asset.trash') }}" key="t-starter-page">@lang('Trash')</a></li>
                        <li><a href="{{ route('asset.log') }}" key="t-maintenance">@lang('Logs')</a></li>
                    </ul>
                </li>
            </ul>

        
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
