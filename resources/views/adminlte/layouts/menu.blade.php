    {{-- <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu" style="background-color: #000">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" key="t-menu">Menu</li>

                    <li>
                        <a href="{{URL('')}}" class="waves-effect">
                            <i class="bx bx-home-circle"></i>
                            <span key="t-dashboards">Dashboards</span>
                        </a>

                    </li>

                    @if (Auth::user()->user_type == '1')
                        <li>
                            <a href="{{URL('annoucments')}}" class="waves-effect">
                                <i class="fas fa-bullhorn"></i>
                                <span key="t-dashboards">Annoucment</span>
                            </a>

                        </li>
                        <li>
                            <a href="{{URL('campaign')}}" class="waves-effect">
                                <i class="bx bxs-spreadsheet"></i>
                                <span key="t-dashboards">Campaign Setup</span>
                            </a>

                        </li>



                    @endif

                    <li>
                        <a href="{{URL('leads')}}" class="waves-effect">
                            <i class="fas fa-list-ul"></i>
                            <span key="t-dashboards">Campaign Leads</span>
                        </a>

                    </li>
                    <li>
                        <a href="{{URL('property_listing')}}" class="waves-effect">
                            <i class="fas fa-inbox"></i>
                            <span key="t-dashboards">Portal Listings Leads</span>
                        </a>

                    </li>
                    <li>
                        <a href="{{URL('website')}}" class="waves-effect">
                            <i class="fas fa-laptop"></i>
                            <span key="t-dashboards">Website Leads</span>
                        </a>

                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-recycle"></i>
                            <span key="t-contacts">Recycle Leads</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{URL('recycle_leads')}}" key="t-user-grid">Campgain Leads</a></li>
                            <li><a href="{{URL('property_listing_leads/recycle_leads')}}" key="t-user-list">Portal Lisitng Leads</a></li>
                            <li><a href="{{URL('website_leads/recycle_leads')}}" key="t-profile">Website Leads</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="far fa-handshake"></i>
                            <span key="t-contacts">Closed Deals</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{URL('closed_deal_leads')}}" key="t-user-grid">Close Campgain Leads</a></li>
                            <li><a href="{{URL('property_listing_leads/closed_deal_leads')}}" key="t-user-list">Close Portal Lisitng Leads</a></li>
                            <li><a href="{{URL('website_leads/closed_deal_leads')}}" key="t-profile">Close Website Leads</a></li>
                        </ul>
                    </li>

                    @if (Auth::user()->user_type == '1')
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bxs-timer"></i>
                                <span key="t-contacts">Temporary Leads</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{URL('temporary_leads')}}" key="t-user-grid">Campgain Leads</a></li>
                                <li><a href="{{URL('property_listing_leads/temporary_leads')}}" key="t-user-list">Portal Lisitng Leads</a></li>
                                <li><a href="{{URL('website_leads/temporary_leads')}}" key="t-profile">Website Leads</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="far fa-trash-alt"></i>
                                <span key="t-contacts">Trash</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{URL('trash_leads')}}" key="t-user-grid">Campgain Leads</a></li>
                                <li><a href="{{URL('property_trash_leads')}}" key="t-user-list">Portal Lisitng Leads</a></li>
                                <li><a href="{{URL('website_trash_leads')}}" key="t-profile">Website Leads</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="{{URL('users')}}" class="waves-effect">
                                <i class="bx bxs-user-detail"></i>
                                <span key="t-dashboards">Manage Team</span>
                            </a>

                        </li>


                    @endif
                    @if (Auth::user()->user_type == 1)
                        <li>
                            <a href="{{URL('leader_board/monthly_ranking')}}" class="waves-effect">
                                <i class="fas fa-chart-bar"></i>
                                <span key="t-dashboards">Monthly Ranking</span>
                            </a>

                        </li>
                    @endif
                    @if (Auth::user()->is_new == '')

                        <li>
                            <a href="{{URL(    'leader_board')}}" class="waves-effect">
                                                     <i class="fas fa-users"></i>
                                <span key="t-dashboards">Leaderboard</span>
                            </a>

                        </li>

                    @endif






                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End --> --}}

    <div class="topnav">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{URL('')}}" id="topnav-dashboard" role="button">
                                <span key="t-dashboards">Dashboards</span>
                            </a>

                        </li>
                        @if (Auth::user()->user_type == '1')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <span key="t-apps">Setup</span> <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="{{URL('annoucments')}}" class="dropdown-item" key="t-calendar">Announcment</a>
                                    <a href="{{URL('campaign')}}" class="dropdown-item" key="t-chat">Campaign Setup</a>
                                    <a href="{{URL('users')}}" class="dropdown-item" key="t-file-manager">Team</a>

                                </div>
                            </li>


                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                <span key="t-apps">Leads</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                <a href="{{URL('leads')}}" class="dropdown-item" key="t-calendar">Campaign Leads</a>
                                <a href="{{URL('property_listing')}}" class="dropdown-item" key="t-chat">Portal Listing Leads</a>
                                <a href="{{URL('website')}}" class="dropdown-item" key="t-file-manager">Website Leads</a>

                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                <span key="t-apps">Recycle Leads</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                <a href="{{URL('recycle_leads')}}" class="dropdown-item" key="t-calendar">Campaign Leads</a>
                                <a href="{{URL('property_listing_leads/recycle_leads')}}" class="dropdown-item" key="t-chat">Portal Listing Leads</a>
                                <a href="{{URL('website_leads/recycle_leads')}}" class="dropdown-item" key="t-file-manager">Website Leads</a>

                            </div>
                        </li>
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                <span key="t-apps">Closed Deals</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                <a href="{{URL('closed_deal_leads')}}" class="dropdown-item" key="t-calendar">Campaign Leads</a>
                                <a href="{{URL('property_listing_leads/closed_deal_leads')}}" class="dropdown-item" key="t-chat">Portal Listing Leads</a>
                                <a href="{{URL('website_leads/closed_deal_leads')}}" class="dropdown-item" key="t-file-manager">Website Leads</a>

                            </div>
                        </li> --}}

                        @if (Auth::user()->user_type == '1')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <span key="t-apps">Temporary Leads</span> <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="{{URL('temporary_leads')}}" class="dropdown-item" key="t-calendar">Campaign Leads</a>
                                    <a href="{{URL('property_listing_leads/temporary_leads')}}" class="dropdown-item" key="t-chat">Portal Listing Leads</a>
                                    <a href="{{URL('website_leads/temporary_leads')}}" class="dropdown-item" key="t-file-manager">Website Leads</a>

                                </div>
                            </li>
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <span key="t-apps">Trash</span> <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="{{URL('trash_leads')}}" class="dropdown-item" key="t-calendar">Campaign Leads</a>
                                    <a href="{{URL('property_trash_leads')}}" class="dropdown-item" key="t-chat">Portal Listing Leads</a>
                                    <a href="{{URL('website_trash_leads')}}" class="dropdown-item" key="t-file-manager">Website Leads</a>

                                </div>
                            </li> --}}

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{URL('listing')}}" id="topnav-dashboard" role="button">
                                    <span key="t-dashboards">Listing</span>
                                </a>

                            </li> --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{URL('leader_board/monthly_ranking')}}" id="topnav-dashboard" role="button">
                                    <span key="t-dashboards">Monthly Ranking</span>
                                </a>

                            </li>




                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{URL('leader_board')}}" id="topnav-dashboard" role="button">
                                <span key="t-dashboards">Leaderboard</span>
                            </a>

                        </li>



                    </ul>
                </div>
            </nav>
        </div>
    </div>
