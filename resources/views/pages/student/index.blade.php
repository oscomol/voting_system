@extends('layout.student')

@section('content')
    <div class="container-fluid header-main bg-info">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center ">
                    <h4>LOGO</h4>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link text-dark" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="fas fa-th-large"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                                style="left: inherit; right: 0px;">

                                <a class="dropdown-item bg-info">
                                    <i class="fa fa-user mr-2"></i> {{$user->name}}
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

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5 px-5">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Latest of Elections</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="electionDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Start At</th>
                                <th>Ent AT</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($elections as $election)
                            <tr>
                                <th>{{$election->electionName}}</th>
                                <td>{{$election->startAt}}</td>
                                <td>{{$election->endAt}}</td>
                                <td>
                                    <a href="{{url('/student/election', ["id" => $election->id])}}" class="btn btn-sm btn btn-info">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

    @include('layout.modals')

@endsection

@section('script')
    <script type="module">
        $(function() {
            $('#electionDataTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('.submitForm').submit(function(){
                $(this).find('.submitBtn').prop('disabled', true).text('Processing...');
            });
        })
    </script>
@endsection

<style>
    .header-main {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        padding: 10px;
    }
</style>
