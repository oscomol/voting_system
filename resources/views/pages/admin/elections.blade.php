@extends('layout.admin')

@section('title')
    Elections
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title">List of Elections</h3>
            <div class="card-tools">
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#new-election-modal">
                    Create new
                </button>
            </div>
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
                                <a href="{{url('/administrator/elections', ["id" => $election->id])}}" class="btn btn-sm btn btn-info">
                                    Manage
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


{{-- Add election modal --}}
<form action="{{route('add-election')}}" method="POST" class="submitForm">
    @csrf
    @method("post")
<div class="modal fade" id="new-election-modal" tabindex="-1" role="dialog" aria-labelledby="modal-default-p-update" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-default-p-update">Create Election Workspace</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="election-name" class="form-label">Election name</label>
                    <input type="text" class="form-control" id="election-name" name="electionName">
                </div>
                <div class="mb-3">
                    <label for="start-at" class="form-label">Start at</label>
                    <input type="datetime-local" class="form-control" id="start-at" name="startAt">
                </div>
                <div class="mb-3">
                    <label for="end-at" class="form-label">End at</label>
                    <input type="datetime-local" class="form-control" id="end-at" name="endAt">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="submitBtn btn btn-success btn-sm">
                    Save
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    Cancel
                </button>
            </div>

        </div>
    </div>
</div>
</form>


@if (session('message'))
<script>
    Swal.fire({
        icon: "success",
        text: "{{ session('success') }}",
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
@endsection