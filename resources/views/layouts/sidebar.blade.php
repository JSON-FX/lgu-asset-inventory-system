<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="dashboard">
                        <i data-feather="home"></i>
                        <span class="badge rounded-pill bg-soft-success text-success float-end">+9</span>
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
                        <li><a href="assetlist" key="t-starter-page">@lang('Assets List')</a></li>
                        <li><a href="create" key="t-maintenance">@lang('Add Asset')</a></li>
                    </ul>
                    
                </li>
                <li>
                    <a href="category">
                        <i data-feather="layers"></i>
                        <span data-key="t-authentication">@lang('Category')</span>
                    </a>
                </li>
                <li>
                    <a href="office">
                        <i data-feather="trello"></i>
                        <span data-key="t-tasks">@lang('Office')</span>
                    </a>
                </li>
                <li>
                    <a href="users">
                        <i data-feather="users"></i>
                        <span data-key="t-contacts">@lang('User')</span>
                    </a>
                </li>
               
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">@lang('Reports')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter" key="t-starter-page">@lang('translation.Starter_Page')</a></li>
                        <li><a href="pages-maintenance" key="t-maintenance">@lang('translation.Maintenance')</a></li>
                        <li><a href="pages-comingsoon" key="t-coming-soon">@lang('translation.Coming_Soon')</a></li>
                        <li><a href="pages-timeline" key="t-timeline">@lang('translation.Timeline')</a></li>
                        <li><a href="pages-faqs" key="t-faqs">@lang('translation.FAQs')</a></li>
                        <li><a href="pages-pricing" key="t-pricing">@lang('translation.Pricing')</a></li>
                        <li><a href="pages-404" key="t-error-404">@lang('translation.Error_404')</a></li>
                        <li><a href="pages-500" key="t-error-500">@lang('translation.Error_500')</a></li>
                    </ul>
                </li>
            </ul>

        
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
