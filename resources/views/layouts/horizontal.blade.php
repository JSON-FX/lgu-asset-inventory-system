<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a  href="{{ route('dashboard') }}"class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="47">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="47"> <span class="logo-txt">PSMD</span>
                    </span>
                </a>

                <a  href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="47">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="47"> <span class="logo-txt">PSMD</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block" id="searchForm" action="/search-properties" method="GET" target="_blank">
                <div class="position-relative">
                    <input type="text" class="form-control" id="searchInput" name="query" placeholder="Search...">
                    <button class="btn btn-primary" type="submit">
                        <i class="bx bx-search-alt align-middle"></i>
                    </button>
                </div>
            </form>
            
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


                
                

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="grid" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="p-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('assets/images/brands/github.png') }}" alt="Github">
                                    <span>GitHub</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('assets/images/brands/bitbucket.png') }}" alt="bitbucket">
                                    <span>Bitbucket</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('assets/images/brands/dribbble.png') }}" alt="dribbble">
                                    <span>Dribbble</span>
                                </a>
                            </div>
                        </div>

                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('assets/images/brands/dropbox.png') }}" alt="dropbox">
                                    <span>Dropbox</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('assets/images/brands/mail_chimp.png') }}" alt="mail_chimp">
                                    <span>Mail Chimp</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="{{ URL::asset('assets/images/brands/slack.png') }}" alt="slack">
                                    <span>Slack</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell" class="icon-lg"></i>
                    {{-- <span class="badge bg-danger rounded-pill">5</span> --}}
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small text-reset text-decoration-underline"> Unread (3)</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div data-simplebar style="max-height: 230px;">
                        <a href="#!" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}"
                                    class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">James Lemire</h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1">It will seem like simplified English.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hours ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#!" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-sm me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="bx bx-cart"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Your order is placed</h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="#!" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-sm me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="bx bx-badge-check"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Your item is shipped</h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="#!" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="{{ URL::asset('assets/images/users/avatar-6.jpg') }}"
                                    class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Salena Layfield</h6>
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hours ago</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div> --}}
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item right-bar-toggle me-2">
                    <i data-feather="settings" class="icon-lg"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{-- <img class="rounded-circle header-profile-user" src="@if (Auth::user()->avatar != ''){{ URL::asset('images/'. Auth::user()->avatar) }}@else{{ URL::asset('assets/images/users/avatar-1.png') }}@endif"
                        alt="Header Avatar"> --}}
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">{{Auth::user()->name}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="apps-contacts-profile "><i class="mdi mdi-account font-size-16 align-middle me-1"></i> Profile</a>
                    {{-- <a class="dropdown-item" href="auth-lock-screen "><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen</a> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">@lang('translation.Logout')</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>

<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a href="{{ route('dashboard') }}" class="nav-link dropdown-toggle arrow-none" href="index " id="topnav-dashboard" role="button">
                            <i data-feather="home"></i><span data-key="t-dashboard">@lang('translation.Dashboards')</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a  href="{{ route('asset') }}"class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i data-feather="box"></i><span data-key="t-apps">@lang('translation.Apps')</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                          


                            
                            <a href="{{ route('asset') }}" class="dropdown-item" data-key="t-chat">@lang('Assetlist')</a>
                            <a href="{{ route('assetlist.create') }}" class="dropdown-item" data-key="t-chat">@lang('Add Asset')</a>

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="{{ route('category.index') }}" class="nav-link dropdown-toggle arrow-none" href="index " id="topnav-dashboard" role="button">
                            <i data-feather="layers"></i><span data-key="t-dashboard">@lang('Category')</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('office.index') }}" class="nav-link dropdown-toggle arrow-none" href="index " id="topnav-dashboard" role="button">
                            <i data-feather="trello"></i><span data-key="t-dashboard">@lang('Office')</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('users.index') }}" class="nav-link dropdown-toggle arrow-none" href="index " id="topnav-dashboard" role="button">
                            <i data-feather="users"></i><span data-key="t-dashboard">@lang('Users')</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('status.index') }}" class="nav-link dropdown-toggle arrow-none" href="index " id="topnav-dashboard" role="button">
                            <i data-feather="activity"></i><span data-key="t-dashboard">@lang('Status')</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('account.index') }}" class="nav-link dropdown-toggle arrow-none" href="index " id="topnav-dashboard" role="button">
                            <i data-feather="book"></i><span data-key="t-dashboard">@lang('Account')</span>
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i data-feather="file-text"></i><span data-key="t-apps">@lang('Reports')</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                          


                            
                            <a href="{{ route('asset.trash') }}" class="dropdown-item" data-key="t-chat">@lang('Trash')</a>
                            <a href="{{ route('asset.log')}}" class="dropdown-item" data-key="t-chat">@lang('Logs')</a>
                            <a href="{{ route('properties.index') }}" class="dropdown-item" data-key="t-chat">@lang('Generate Report')</a>

                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<script>
    window.onload = function() {
        document.getElementById('searchInput').focus();
    };
    function searchProperties() {
        let query = document.getElementById('searchInput').value;
        
        // Only make the request if there are at least 3 characters in the search query
        if (query.length >= 3) {
            fetch(`/search-properties?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let resultsContainer = document.getElementById('propertyResults');
                    resultsContainer.innerHTML = ''; // Clear previous results
                    
                    if (data.length === 0) {
                        resultsContainer.innerHTML = '<p>No results found</p>';
                    } else {
                        data.forEach(property => {
                            let resultItem = document.createElement('div');
                            resultItem.classList.add('result-item');
                            resultItem.innerHTML = `<strong>${property.property_number}</strong>: ${property.description}`;
                            resultsContainer.appendChild(resultItem);
                        });
                    }
                });
        } else {
            document.getElementById('propertyResults').innerHTML = ''; // Clear results if the input is too short
        }
    }
</script>



    
    
