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

    <style>
        .mega-hover:hover {
            color: #fff;
        }
    </style>

    <div class="topnav" style="box-shadow: 0px 8px 20px -5px  #666666;">
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse d-flex" id="topnav-menu-content">
                    <ul class="navbar-nav d-flex">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{URL('')}}" id="topnav-dashboard" role="button">
                                <span key="t-dashboards">Dashboards</span>
                            </a>

                        </li>

                        @if (Auth::user()->user_type == '1')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{URL('listings')}}" id="topnav-dashboard" role="button">
                                    <span key="t-dashboards">Listings</span>
                                </a>

                            </li>
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <span key="t-apps">Setup</span> <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="{{URL('annoucments')}}" class="dropdown-item" key="t-calendar">Announcment</a>
                                    <a href="{{URL('campaign')}}" class="dropdown-item" key="t-chat">Campaign Setup</a>
                                    <a href="{{URL('users')}}" class="dropdown-item" key="t-file-manager">Team</a>

                                </div>
                            </li> --}}


                        @endif






                        {{-- Marketing menu for Admin --}}
                        @if (Auth::user()->user_type == '1')
                        <div class=" nav-item dropdown dropdown-mega  ms-2 mega-hover text-left" id="topnav-dashboard" role="button">
                            <a class="nav-link dropdown-toggle arrow-one py-3 text-left" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                <span key="t-megamenu" class="mega_hover text-bold text-lg-light text-sm-dark float-left " style="opacity: .6;">Marketing<i class="mdi mdi-chevron-down float-left"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-megamenu" style="">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <div class="row">



                                            <div class="col-md-3">
                                                <h5 class="font-size-14 text-decoration-underline" key="t-ui-components">Leads</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="{{URL('leads')}}" class="" key="t-calendar">Campaign Leads</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{URL('property_listing')}}" class="" key="t-chat">Portal Listing Leads</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{URL('website')}}" class="" key="t-file-manager">Website Leads</a>
                                                    </li>
                                                </ul>
                                            </div>



                                            <div class="col-md-3">
                                                <h5 class="font-size-14 text-decoration-underline mt-3" key="t-applications">Recycle Leads</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="{{URL('recycle_leads')}}" class="" key="t-calendar">Campaign Leads</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{URL('property_listing_leads/recycle_leads')}}" class="" key="t-chat">Portal Listing Leads</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{URL('website_leads/recycle_leads')}}" class="" key="t-file-manager">Website Leads</a>
                                                    </li>
                                                </ul>
                                            </div>


                                            <div class="col-md-3">
                                                <h5 class="font-size-14 text-decoration-underline mt-3" key="t-extra-pages">Temporary Leads</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="{{URL('temporary_leads')}}" class="" key="t-calendar">Campaign Leads</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{URL('property_listing_leads/temporary_leads')}}" class="" key="t-chat">Portal Listing Leads</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{URL('website_leads/temporary_leads')}}" class="" key="t-file-manager">Website Leads</a>
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="col-sm-6">
                                                    <h5 class="font-size-14 text-decoration-underline mt-3" key="t-ui-components">Setup</h5>
                                                    <ul class="list-unstyled megamenu-list">
                                                        <li>
                                                            <a href="{{URL('annoucments')}}" class="" key="t-calendar">Announcment</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{URL('campaign')}}" class="" key="t-chat">Campaign Setup</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                {{-- <div class="col-sm-5">
                                                    <div>
                                                        <img src="assets/images/megamenu-img.png" alt="" class="img-fluid mx-auto d-block">
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>




                                </div>

                            </div>
                        </div>
                        {{-- /Marketing menu for Admin --}}


                        {{-- Marketing menu for Agents --}}
                        @else
                        <div class="dropdown dropdown-mega  ms-2" id="topnav-dashboard" role="button">
                            <button type="button" class="btn btn-block waves-effect py-3 w-md" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                <span key="t-megamenu" class=" text-bold text-light float-left" style="opacity: .6;">Marketing<i class="mdi mdi-chevron-down float-left"></i></span>

                            </button>
                            <div class="dropdown-menu dropdown-megamenu" style="">
                                <div class="row">


                                    <div class="col-sm-12">
                                        <div class="row">



                                            <div class="col-md-6">
                                                <h5 class="font-size-14 text-decoration-underline" key="t-ui-components">Leads</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="{{URL('leads')}}" class="" key="t-calendar">Campaign Leads</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{URL('property_listing')}}" class="" key="t-chat">Portal Listing Leads</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{URL('website')}}" class="" key="t-file-manager">Website Leads</a>
                                                    </li>
                                                </ul>
                                            </div>



                                            <div class="col-md-6">
                                                <h5 class="font-size-14 text-decoration-underline mt-3" key="t-applications">Recycle Leads</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="{{URL('recycle_leads')}}" class="" key="t-calendar">Campaign Leads</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{URL('property_listing_leads/recycle_leads')}}" class="" key="t-chat">Portal Listing Leads</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{URL('website_leads/recycle_leads')}}" class="" key="t-file-manager">Website Leads</a>
                                                    </li>
                                                </ul>
                                            </div>


                                        </div>
                                    </div>


                                </div>


                            </div>
                        </div>
                        @endif
                        {{-- /Marketing menu for Agents --}}










                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                <span key="t-apps">Leads</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                <a href="{{URL('leads')}}" class="dropdown-item" key="t-calendar">Campaign Leads</a>
                                <a href="{{URL('property_listing')}}" class="dropdown-item" key="t-chat">Portal Listing Leads</a>
                                <a href="{{URL('website')}}" class="dropdown-item" key="t-file-manager">Website Leads</a>

                            </div>
                        </li> --}}

                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                <span key="t-apps">Recycle Leads</span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                <a href="{{URL('recycle_leads')}}" class="dropdown-item" key="t-calendar">Campaign Leads</a>
                                <a href="{{URL('property_listing_leads/recycle_leads')}}" class="dropdown-item" key="t-chat">Portal Listing Leads</a>
                                <a href="{{URL('website_leads/recycle_leads')}}" class="dropdown-item" key="t-file-manager">Website Leads</a>

                            </div>
                        </li> --}}

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

                        {{-- @if (Auth::user()->user_type == '1')
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

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{URL('leader_board/monthly_ranking')}}" id="topnav-dashboard" role="button">
                                    <span key="t-dashboards">Monthly Ranking</span>
                                </a>

                            </li>




                        @endif --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{URL('leader_board')}}" id="topnav-dashboard" role="button">
                                <span key="t-dashboards">Leaderboard</span>
                            </a>

                        </li>
                        @if (Auth::user()->team_leader == '1')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{URL('team')}}" id="topnav-dashboard" role="button">
                                    <span key="t-dashboards">My Team</span>
                                </a>

                            </li>
                        @endif
                        @if (Auth::user()->user_type == '1')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{URL('users')}}" id="topnav-dashboard" role="button">
                                <span key="t-dashboards">Team</span>
                            </a>


                        </li>
                        @endif
                        @if (Auth::user()->user_type == '1')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{URL('statistics')}}" id="topnav-dashboard" role="button">
                                <span key="t-dashboards">Statistics</span>
                            </a>


                        </li>
                        @endif


                        {{-- @if (Auth::user()->user_type == '2')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{URL('team')}}" id="topnav-dashboard" role="button">
                                    <span key="t-dashboards">Analytics</span>
                                </a>

                            </li>
                        @endif --}}



                    </ul>
                </div>
            </nav>
        </div>
    </div>
