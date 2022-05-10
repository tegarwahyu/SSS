{{-- Navbar for unauthenticated users--}}
<nav class="navbar navbar-top navbar-expand-md navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <!-- penambahan style gambar logo hir -->
            <img src="{{ asset('assets/img/logoSSS.png') }}" style="height:50px !important; margin-left: 50%;" />
            <!-- sampai hir -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('admin') }}">
                            <img src="{{ asset('assets/img/logoSSS.png') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navbar items -->

            <ul class="navbar-nav mr-auto ml-4 d-md-flex">

                @hasanyrole('Super Admin|HR Staff|HR Manager')

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="ikon ni ni-single-02"></i>
                        <span id="menu_id" class="nav-link-inner--text">{{ __('Employee') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        @hasanyrole('Super Admin|HR Staff|HR Manager')
                        <a  class="dropdown-item" href="{{ route('hr') }}"><i class="ikon fa fa-users"></i><span id="menu_id">{{ __('Data Pegawai') }}</span></a>
                        <a  class="dropdown-item" href="{{route('userTidakAktif')}}"><i class="ikon fa fa-users"></i><span id="menu_id">{{ __('Data Pegawai Tidak Aktif') }}</span></a>
                        @endhasanyrole
                        @hasanyrole('Super Admin')
                        <a  class="dropdown-item" href="{{ route('roles.index') }}"><i class="ikon ni ni-lock-circle-open"></i><span id="menu_id">{{ __('Role') }}</span></a>
                        <a class="dropdown-item" href="{{ route('permissions.index') }}"><i class="ikon ni ni-check-bold"></i><span id="menu_id">{{ __('Permission') }}</span></a>
                        @endhasanyrole
                    </div>
                </li>
                @endhasanyrole

                @if((Auth::user()->jabatan == 'Desk Collection' || Auth::user()->jabatan == 'Leader DC' || Auth::user()->jabatan == 'Supervisor DC') && (Auth::user()->resume && Auth::user()->f_ktp && Auth::user()->f_kk && Auth::user()->f_ijazah))
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="ni ni-chart-bar-32"></i>
                            <span id="menu_id" class="nav-link-inner--text">{{ __('Salary') }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            @hasanyrole('Super Admin|HR Manager')
                            <a  class="dropdown-item" href="{{ route('salary') }}"><i class="ni ni-chart-bar-32"></i><span>{{ __('List Salary') }}</span></a>
                            @endhasanyrole
                            <a  class="dropdown-item" href="{{route('salaryById')}}"><i class="ikon ni ni-lock-circle-open"></i><span>{{ __('Salary Ku') }}</span></a>
                        </div>
                    </li>
                @else
                    @if((Auth::user()->jabatan == 'Desk Collection' || Auth::user()->jabatan == 'Leader DC' || Auth::user()->jabatan == 'Supervisor DC') == false)
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="ni ni-chart-bar-32"></i>
                                <span id="menu_id" class="nav-link-inner--text">{{ __('Salary') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                @hasanyrole('Super Admin|HR Manager')
                                <a  class="dropdown-item" href="{{ route('salary') }}"><i class="ni ni-chart-bar-32"></i><span>{{ __('List Salary') }}</span></a>
                                @endhasanyrole
                                <a  class="dropdown-item" href="{{route('salaryById')}}"><i class="ikon ni ni-lock-circle-open"></i><span>{{ __('Salary Ku') }}</span></a>
                            </div>
                        </li>
                    @endif
                @endif



            </ul>

            @if(config('rivela.searchbar')==true)
            <!-- Form search-->
            <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search" type="text">
                    </div>
                </div>
            </form>
            @endif

            @include('layouts.navbars.navs.user')
        </div>
    </div>
</nav>
