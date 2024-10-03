@extends('layout.admin')

@section('title')
    Election: {{ $election->electionName }}
@endsection

@section('moreOption')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="btn btn-sm btn btn-info" data-toggle="dropdown" href="#" aria-expanded="false">
                More actions
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <a class="dropdown-item bg-info">
                    Manage Election
                </a>
                <a class="dropdown-item" data-toggle="modal" data-target="#updateElection">
                    <i class="fa fa-edit mr-2"></i> Update
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" data-toggle="modal" data-target="#delete-election">
                    <i class="fa fa-trash mr-2"></i> Delete
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" data-toggle="modal" data-target="#add-team">
                    <i class="fa fa-users mr-2"></i> Add Team
                </a>
                <a href="{{url('/administrator/elections/analysis', ["id" => $election->id])}}" class="dropdown-item" >
                    <i class="fa fa-line-chart mr-2"></i> Vote Analysis
                </a>
            </div>
        </li>
    </ul>
@endsection
@section('content')
    <div class="container-fluid">
        @if ($election->teams->count() > 0)
            @foreach ($election->teams as $team)
                <div class="modal fade" id="delete-team-{{ $team->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="modal-default-p-update" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-default-p-update">Confirm Logout</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure to delete this team ?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('delete-team', ['id' => $team->id]) }}" method="POST"
                                    class="submitForm">
                                    @csrf
                                    @method('delete')
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

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            {{ $team->teamName }}
                        </div>
                        <div class="card-tools">
                            <button type="button" class="bt btn-sm btn btn-danger" data-toggle="modal"
                                data-target="#delete-team-{{ $team->id }}">
                                <li class="fa fa-trash"></li>
                            </button>
                            <button type="button" class="bt btn-sm btn btn-success" data-toggle="modal"
                                data-target="#add-participants-{{ $team->id }}">
                                <li class="fa fa-user-plus"></li>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($team->participants as $participant)
                                @if ($participant->hasParticipant)
                                    <div class="col-6 col-sm-2">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="participants-viewer">
                                                    <img src="{{ url('/participants/image/' . $participant->photo) }}"
                                                        alt="Photo">
                                                </div>
                                            </div>
                                            <div class="card-footer px-2 py-1">
                                                <span style="font-size: 13px;">
                                                    {{ $participant->participantsName }} <br>
                                                    {{ $participant->position }}
                                                    <span class="float-right mt-1" data-toggle="modal"
                                                        data-target="#delete-participant-{{ $participant->id }}">
                                                        <li class="fa fa-trash"></li>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="delete-participant-{{ $participant->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modal-default-p-update" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal-default-p-update">Confirm Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to delete this participants ?
                                                </div>
                                                <div class="modal-footer">
                                                    <form
                                                        action="{{ route('participant-delete', ['id' => $participant->id]) }}"
                                                        method="POST" class="submitForm">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="submitBtn btn btn-success btn-sm">
                                                            Continue
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-6 col-sm-2">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="participants-viewer">
                                                    <img src="{{ url('/photos/add-candidate.png') }}" alt="Photo">
                                                </div>
                                            </div>
                                            <div class="card-footer px-2 pt-3">
                                                <span style="font-size: 13px;">
                                                    {{ $participant->position }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <form action="{{ route('add-participant', ['id' => $team->id]) }}" method="POST" class="submitForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="modal fade" id="add-participants-{{ $team->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="modal-default-p-update" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-default-p-update">{{ $team->teamName }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="photo-container">
                                        <label for="photo-picker-{{ $team->id }}" class="add-photo-btn">
                                            <img src="{{ url('/photos/add-candidate.png') }}" alt="Add-photo"
                                                style="width: 130px; height: 130px;">
                                        </label>
                                        <input type="file" class="photo-picker" id="photo-picker-{{ $team->id }}"
                                            style="display: none;" accept="image/*" name="photo">

                                        <img src="{{ url('/photos/add-candidate.png') }}" alt="Add-photo"
                                            class="preview-photo d-none">

                                        <label for="photo-picker-{{ $team->id }}"
                                            class="btn btn-sm btn btn-success d-none edit-photo-btn">
                                            <li class="fa fa-edit"></li>
                                        </label>
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="participantsName-{{ $team->id }}" class="form-label">Name</label>
                                        <input type="text" class="form-control"
                                            id="participantsName-{{ $team->id }}" name="participantsName">
                                    </div>
                                    <div class="mb-3">
                                        <label for="participantsAdvocacy-{{ $team->id }}"
                                            class="form-label">Advocacy</label>
                                        <textarea class="form-control" id="participantsAdvocacy-{{ $team->id }}" rows="3"
                                            name="participantsAdvocacy"></textarea>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="position-{{ $team->id }}" class="form-label">Position</label>
                                        <select class="form-control" id="position-{{ $team->id }}" name="position">
                                            <option value="President">President</option>
                                            <option value="Vice President">Vice President</option>
                                            <option value="Secretary">Secretary</option>
                                            <option value="Treasurer">Treasurer</option>
                                            <option value="Auditor">Auditor</option>
                                            <option value="PIO">PIO</option>
                                            <option value="Protocol Officer">Protocol Officer</option>
                                            <option value="Grade 7 Representative">Grade 7 Representative</option>
                                            <option value="Grade 8 Representative">Grade 8 Representative</option>
                                            <option value="Grade 9 Representative">Grade 9 Representative</option>
                                            <option value="Grade 10 Representative">Grade 10 Representative</option>
                                            <option value="Grade 11 Representative">Grade 11 Representative</option>
                                            <option value="Grade 12 Representative">Grade 12 Representative</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="submitBtn btn btn-success btn-sm">
                                        Continue
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        @else
            Empty
        @endif
    </div>


    {{-- UPDATE ELECTION --}}
    <form action="{{ route('election-update', ['id' => $election->id]) }}" method="POST" class="submitForm">
        @csrf
        @method('put')
        <div class="modal fade" id="updateElection" tabindex="-1" role="dialog"
            aria-labelledby="modal-default-p-update" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-default-p-update">Update Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="election-name-{{ $election->id }}" class="form-label">Election name</label>
                            <input type="text" class="form-control" id="election-name-{{ $election->id }}"
                                name="electionName" value="{{ $election->electionName }}">
                        </div>
                        <div class="mb-3">
                            <label for="start-at-{{ $election->id }}" class="form-label">Start at</label>
                            <input type="datetime-local" class="form-control" id="start-at-{{ $election->id }}"
                                name="startAt" value="{{ $election->startAt }}">
                        </div>
                        <div class="mb-3">
                            <label for="end-at-{{ $election->id }}" class="form-label">End at</label>
                            <input type="datetime-local" class="form-control" id="end-at-{{ $election->id }}"
                                name="endAt" value="{{ $election->endAt }}">
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

    <div class="modal fade" id="delete-election" tabindex="-1" role="dialog" aria-labelledby="modal-default-p-update"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-default-p-update">Confirm Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this election ?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('election-delete', ['id' => $election->id]) }}" method="POST"
                        class="submitForm">
                        @csrf
                        @method('delete')
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

    <form action="{{ route('add-team', ['id' => $election->id]) }}" method="POST" class="submitForm">
        @csrf
        @method('post')
        <div class="modal fade" id="add-team" tabindex="-1" role="dialog" aria-labelledby="modal-default-p-update"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-default-p-update">Add a Team</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="teamName" class="form-label">Team name</label>
                            <input type="text" class="form-control" id="teamName" name="teamName">
                        </div>
                        <div class="mb-3">
                            <label for="teamAdvocacy" class="form-label">Advocacy (Optional)</label>
                            <textarea class="form-control" id="teamAdvocacy" rows="3" name="teamAdvocacy"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="submitBtn btn btn-success btn-sm">
                            Continue
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script type="module">
        $(function() {
            $('.select-photo').click(function() {


            })
        })

        $(".photo-picker").change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('.add-photo-btn').addClass('d-none');
                    $('.edit-photo-btn').removeClass('d-none');
                    $(`.preview-photo`).removeClass('d-none').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection


<style>
    .photo-container {
        width: 60%;
        height: 200px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px solid lightgray;
        overflow: hidden;
        position: relative;
        /* Required for absolute positioning inside */
    }

    .preview-photo {
        width: 100%;
        height: auto;
    }

    .edit-photo-btn {
        position: absolute;
        /* Enables positioning */
        bottom: 10px;
        /* Position the button 10px from the bottom */
        right: 10px;
        /* Position the button 10px from the right */
        z-index: 10;
        /* Ensures the button is above the image */
        padding: 5px 10px;
    }

    .participants-viewer {
        width: 100%;
        height: 140px;
    }

    .participants-viewer img {
        width: 100%;
        height: 100%;
    }
</style>
