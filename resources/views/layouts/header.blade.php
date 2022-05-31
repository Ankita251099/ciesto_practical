 <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <span class="logo-abbr"></span>
                <span class="logo-compact">Prectical</span>
                <span class="brand-title">Prectical</span>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="header-left">
                        <!--  -->
                    </div>
                    <div class="collapse navbar-collapse justify-content-end">

                        <ul class="navbar-nav header-right">
                            
                           
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{asset('images/users/2.jpg')}}" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-profile-header">
                                        <img src="images/users/2.jpg" alt="">
                                        <span class="avatar-name ml-2"> {{ Auth::user()->name ?? '' }}</span>
                                    </div>
                               
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>