<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css'])

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ url('/photos/logo.png') }}" alt="AdminLTELogo" height="60"
                width="60"><br>
            <p class="animation__wobble">Clinic Reservation System</p>
        </div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-th-large"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">

                        <a class="dropdown-item bg-info">
                            <i class="fa fa-user mr-2"></i> {{ $user->name }}
                        </a>

                        <a class="dropdown-item" data-toggle="modal" data-target="#UpdateModal">
                            <i class="fa fa-edit mr-2"></i> Update account
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#delete-account">
                            <i class="fa fa-trash mr-2"></i> Delete account
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#logout">
                            <i class="fa fa-lock mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ url('/photos/logo.png') }}" alt="AdminLTE Logo" class="img-circle elevation-3"
                    style="opacity: .8; width: 40px; height: 40px;">
                <span class="brand-text font-weight-light">SMARTHUB</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-2 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ url('/photos/userLogin.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ ucfirst($user->userType) }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ url('/administrator/dashboard') }}"
                                class="nav-link {{ request()->is('administrator/dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/administrator/elections') }}"
                                class="nav-link {{ request()->is('administrator/elections') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-file"></i>
                                <p>
                                    Election List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/administrator/students') }}"
                                class="nav-link {{ request()->is('administrator/students') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-address-book"></i>
                                <p>
                                    Students
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>





        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                  <div class="d-flex justify-content-between pr-2">
                    <div class="col-sm-6">
                      <h1 class="m-0">@yield('title')</h1>
                  </div>
                  @yield('moreOption')
                  </div>
                </div>
            </div>


            <section class="content">
                @yield('content')
            </section>
        </div>
        <aside class="control-sidebar control-sidebar-dark">

        </aside>
    </div>

    @include('layout.modals')



    @if (session('message'))
    <script>
        Swal.fire({
            icon: "success",
            text: "{{ session('message') }}",
            timer: 3000
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: "error",
            text: "{{ session('error') }}",
            timer: 3000
        });
    </script>
@endif

    @vite(['resources/js/app.js'])

    @yield('script')



</body>

</html>

<script type="module">
    $(function() {
        $('.submitForm').submit(function() {
            $(this).find('.submitBtn').prop('disabled', true).text('Processing...');
        });
    })
</script>

<style>
    .customStyle {
        border-bottom: 1px solid gray;
        margin-bottom: 10px;
    }
</style>
