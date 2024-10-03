<form action="{{route('student-update', ["studentId" => $user->id])}}" method="POST" class="submitForm">
    @csrf
    @method('put')
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="modal-default-p-update" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-default-p-update">Update Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name" name="name" value="{{$user->name}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="Phone number" name="phone" value="{{$user->phone}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="ID number" name="lrn" value="{{$user->lrn}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-book"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit"class="btn btn-success btn-sm submitBtn">
                        Update
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        Cancel
                    </button>
                </div>

            </div>
        </div>
    </div>
  </form>

  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="modal-default-p-update" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-default-p-update">Confirm Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to logout ?
            </div>
            <div class="modal-footer">
                <form action="{{route('logout')}}" method="GET" class="submitForm">
                    @csrf
                    @method('get')
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


<div class="modal fade" id="delete-account" tabindex="-1" role="dialog" aria-labelledby="modal-default-p-update" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-default-p-update">Confirm Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to delete your account ?
            </div>
            <div class="modal-footer">
                <form action="{{url('/account/delete', ["studentId" => $user->id])}}" method="GET" class="submitForm">
                    @csrf
                    @method('get')
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