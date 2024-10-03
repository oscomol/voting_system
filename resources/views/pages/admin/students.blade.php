@extends('layout.admin')

@section('title')
    Students
@endsection

@section('content')





<div class="container-fluid">
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title">List of Studets</h3>
            <div class="card-tools">
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#new-election-modal">
                    Create new
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="studentAdminDataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>LRN</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($students as $student)
                           <tr>
                                <td>{{$student->name}}</td>
                                <td>{{$student->lrn}}</td>
                                <td>{{$student->phone}}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#reset-password-{{ $student->id }}">
                                        Reset
                                    </button>
                                </td>
                           </tr>

                           <div class="modal fade" id="reset-password-{{ $student->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal-default-p-update" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal-default-p-update">Reset Passowrd</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to reset password for student <strong>{{$student->name}}</strong> ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('reset.password', ['id' => $student->id]) }}" method="POST"
                                            class="submitForm">
                                            @csrf
                                            @method('post')
                                            <button type="submit" class="submitBtn btn btn-success btn-sm">
                                                Continue
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('script')
    <script type="module">
        $(function() {
            $('#studentAdminDataTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
    </script>
@endsection
