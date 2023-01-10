<div class="topnav d-flex justify-content-center shadow-sm font-size-16" style="box-shadow: 0px 2px 20px -5px  #000; background-color: #000; color: #000; >
    <div class="container">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu" >

            <div class="collapse navbar-collapse active" id="topnav-menu-content">
                <ul class="navbar-nav active d-flex justify-content-center text-center align-middle mx-auto">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none fw-bold " style="color: white;" href="{{URL('')}}" id="topnav-dashboard" role="button">
                            <i class="bx bx-home-circle me-2"></i><span key="t-dashboards">Dashboards</span>
                        </a>
                    </li>

                    @if (Auth::user()->user_type == '1')
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{URL('listing')}}" id="topnav-dashboard" role="button">
                                <i class="bx bx-list-ol me-2"></i><span key="t-dashboards">Listings</span>
                            </a>

                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{URL('listing2')}}" id="topnav-dashboard" role="button">
                                <i class="bx bx-list-ol me-2"></i><span key="t-dashboards">Listings v2</span>
                            </a>
                        </li> --}}
                    @endif








                    {{-- Marketing --}}
                    @if (Auth::user()->user_type == '1')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none  fw-bold" href="#" id="topnav-pages" role="button" style="color: white;">
                             <i class="bx bx-shopping-bag me-2"></i><span key="t-apps">Marketing Apps</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <a href="{{URL('all_leads')}}" class="dropdown-item fw-bold " key="t-chat"  style="color: #737373;">
                                <i class="bx bx-customize me-2"></i>
                                All Leads
                            </a>
                            <a href="{{URL('all_deals')}}" class="dropdown-item fw-bold " key="t-chat" style="color: #737373;">
                                <i class="bx bx-trash me-2"></i>
                                Closed Deals
                            </a>
                            <a href="{{URL('all_recycle')}}" class="dropdown-item fw-bold " key="t-chat" style="color: #737373;">
                                <i class="bx bx-trash me-2"></i>
                                Recycle
                            </a>
                            <a href="{{URL('all_temporary')}}" class="dropdown-item fw-bold " key="t-chat" style="color: #737373;">
                                <i class="bx bx-time me-2"></i>
                                Temporary
                            </a>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none  fw-bold " href="#" id="topnav-email" role="button" style="color: #737373;">
                                    <i class="bx bx-cog me-2"></i>
                                    <span key="t-calendar">Setup</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <a href="{{URL('annoucments')}}" class="dropdown-item  fw-bold" key="t-tui-calendar" style="color: #737373;">Announcment</a>
                                    <a href="{{URL('campaign')}}" class="dropdown-item  fw-bold" key="t-full-calender" style="color: #737373;">Campaign Setup</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button">
                            <i class="bx bx-shopping-bag me-2"></i>
                            <span key="t-ui-elements"> Marketing</span>
                            <div class="arrow-down"></div>
                        </a>

                        <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                            <div class="row m-1">

                                <div class="col-lg-3 mr-1">
                                    <h5 class="font-size-14 text-decoration-underline mt-3" key="t-ui-components">Leads</h5>

                                    <div>
                                        <a href="{{URL('all_leads')}}" class="dropdown-item" key="t-alerts">All Leads</a>
                                        <a href="{{URL('leads')}}" class="dropdown-item" key="t-alerts">Campaign leads</a>
                                        <a href="{{URL('property_listing')}}" class="dropdown-item" key="t-buttons">Portal leads</a>
                                        <a href="{{URL('website')}}" class="dropdown-item" key="t-cards">Website leads</a>
                                    </div>
                                </div>
                                <div class="col-lg-3 mr-1">
                                    <h5 class="font-size-14 text-decoration-underline mt-3" key="t-ui-components">Recycle Leads</h5>

                                    <div>
                                        <a href="{{URL('all_recycle')}}" class="dropdown-item" key="t-alerts">All Recycle</a>
                                        <a href="{{URL('recycle_leads')}}" class="dropdown-item" key="t-alerts">Campaign leads</a>
                                        <a href="{{URL('property_listing_leads/recycle_leads')}}" class="dropdown-item" key="t-buttons">Portal leads</a>
                                        <a href="{{URL('website_leads/recycle_leads')}}" class="dropdown-item" key="t-cards">Website leads</a>
                                    </div>
                                </div>
                                <div class="col-lg-3 pr-1">
                                    <h5 class="font-size-14 text-decoration-underline mt-3" key="t-ui-components">Temporary Leads</h5>

                                    <div>
                                        <a href="{{URL('all_temporary')}}" class="dropdown-item" key="t-alerts">All Temporary</a>
                                        <a href="{{URL('temporary_leads')}}" class="dropdown-item" key="t-alerts">Campaign leads</a>
                                        <a href="{{URL('property_listing_leads/temporary_leads')}}" class="dropdown-item" key="t-buttons">Portal leads</a>
                                        <a href="{{URL('website_leads/temporary_leads')}}" class="dropdown-item" key="t-cards">Website leads</a>
                                    </div>
                                </div>
                                <div class="col-lg-3 pr-1">
                                    <h5 class="font-size-14 text-decoration-underline mt-3" key="t-ui-components">Setup</h5>

                                    <div>
                                        <a href="{{URL('annoucments')}}" class="dropdown-item" key="t-alerts">Announcment</a>
                                        <a href="{{URL('campaign')}}" class="dropdown-item" key="t-buttons">Campaign Setup</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li> --}}
                    @else

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none  fw-bold" href="#" id="topnav-pages" role="button" style="color: white;">
                             <i class="bx bx-shopping-bag me-2"></i><span key="t-apps">Marketing Apps</span> <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <a href="{{URL('all_leads')}}" class="dropdown-item fw-bold " key="t-chat" style="color: #737373;">
                                <i class="bx bx-customize me-2"></i>
                                My Leads
                            </a>
                            <a href="{{URL('my_deals')}}" class="dropdown-item fw-bold " key="t-chat" style="color: #737373;">
                                <i class="bx bx-trash me-2"></i>
                                My Closed Deals
                            </a>
                            <a href="{{URL('all_recycle')}}" class="dropdown-item fw-bold " key="t-chat" style="color: #737373;">
                                <i class="bx bx-trash me-2"></i>
                                Recycled Leads
                            </a>

                        </div>
                    </li>



                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button">
                            <i class="bx bx-shopping-bag me-2"></i>
                            <span key="t-ui-elements"> Marketing</span>
                            <div class="arrow-down"></div>
                        </a>

                        <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                            <div class="row m-1">

                                <div class="col-lg-6 mr-1">
                                    <h5 class="font-size-14 text-decoration-underline mt-3" key="t-ui-components">Leads</h5>

                                    <div>
                                        <a href="{{URL('all_leads')}}" class="dropdown-item" key="t-alerts">All Leads</a>
                                        <a href="{{URL('leads')}}" class="dropdown-item" key="t-alerts">Campaign leads</a>
                                        <a href="{{URL('property_listing')}}" class="dropdown-item" key="t-buttons">Portal leads</a>
                                        <a href="{{URL('website')}}" class="dropdown-item" key="t-cards">Website leads</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 mr-1">
                                    <h5 class="font-size-14 text-decoration-underline mt-3" key="t-ui-components">Recycle Leads</h5>

                                    <div>
                                        <a href="{{URL('all_recycle')}}" class="dropdown-item" key="t-alerts">All Recycle</a>
                                        <a href="{{URL('recycle_leads')}}" class="dropdown-item" key="t-alerts">Campaign leads</a>
                                        <a href="{{URL('property_listing_leads/recycle_leads')}}" class="dropdown-item" key="t-buttons">Portal leads</a>
                                        <a href="{{URL('website_leads/recycle_leads')}}" class="dropdown-item" key="t-cards">Website leads</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li> --}}

                    @endif
                    {{-- /Marketing --}}








                    @if(Auth::user()->user_type == '1')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none  fw-bold" href="{{URL('daily-reports')}}" id="topnav-pages" role="button" style="color: white;">
                            <i class="bx bxs-report me-2"></i><span key="t-apps">
                                Daily Reports
                            </span>
                        </a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none  fw-bold" href="{{URL('my-daily-reports')}}" id="topnav-pages" role="button" style="color: white;">
                            <i class="bx bxs-report me-2"></i><span key="t-apps">
                                Daily Reports
                            </span>
                        </a>
                    </li>
                    @endif











                    @if (Auth::user()->user_type == '1')
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{URL('statistics')}}" id="topnav-pages" role="button">
                            <i class="bx bx-line-chart me-2"></i><span key="t-apps">Statistics</span>
                        </a>
                    </li> --}}
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none  fw-bold" href="{{URL('leader_board')}}" id="topnav-pages" role="button" style="color: white;">
                            <i class="bx bx-trending-up me-2"></i><span key="t-apps">
                                Leaderboard
                            </span>
                        </a>
                    </li>
                    @if (Auth::user()->team_leader == '1')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none  fw-bold" href="{{URL('team')}}" id="topnav-pages" role="button" style="color: white;">
                            <i class="bx bx-cog me-2"></i><span key="t-apps">Team Leads</span>
                        </a>
                    </li>
                    @endif

                    @if (Auth::user()->user_type == '1')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none  fw-bold" href="{{URL('users')}}" id="topnav-pages" role="button" style="color: white;">
                            <i class="bx bxs-user-plus me-2"></i><span key="t-apps">Staff</span>
                        </a>
                    </li>
                    @endif



                </ul>
            </div>
        </nav>
    </div>
</div>

<script>
    // $(document).on('change', '.div-toggle', function() {
    //       var target = $(this).data('target');
    //       var show = $("option:selected", this).data('show');
    //       $(target).children().addClass('hide');
    //       $(show).removeClass('hide');
    //     });
    //     $(document).ready(function(){
    //         $('.div-toggle').trigger('change');
    //     });
</script>
