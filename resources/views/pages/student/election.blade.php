@extends('layout.student')

@section('content')
<input type="hidden" id="electionId" value="{{$election->id}}">
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
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5 px-5">
        @foreach ($participants as $position => $participantSet)
        <div class="card mb-3">
            <div class="card-header">
                <div class="card-title">
                    <strong>{{ $position }}</strong>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($participantSet as $participant)
                        @if ($participant !== null)
                            <div class="col-3 participant" id="{{ $loop->parent->index }}-{{ $participant->id }}" position="{{ $loop->parent->index }}" participant="{{$participant->id}}">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-header-title">
                                            {{ $participant->team->teamName }}
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="participants-viewer">
                                            <img src="{{ url('/participants/image/' . $participant->photo) }}" alt="Photo" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        {{ $participant->participantsName }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
    
    </div>
    
@endsection
@section('script')
    <script type="module">
        $(function(){

            let votes = [];

            $(".participant").click(function() {
                const election = $("#electionId").val();
                const position = $(this).attr('position');
                const participant = $(this).attr('participant');

                let existingVote = votes.find(vote => vote.position === position);
                $(`#${position}-${participant}`).addClass('voted');

                if (existingVote) {
                   $(`#${position}-${existingVote.participant}`).removeClass('voted');
                   votes = [...votes.filter(item => item.position !== position), {...existingVote, participant: participant}]
                } else {
                    votes.push({ election, position, participant });
                }
                console.log(votes);
            });

        })
    </script>
@endsection

<style>
       .header-main {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        padding: 10px;
    }
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

    .participants-viewer {
        width: 100%;
        height: 140px;
    }

    .participants-viewer img {
        width: 100%;
        height: 100%;
    }
    .voted {
    background-color: #4CAF50; /* A green background for selected participants */
    cursor: not-allowed;       /* Prevent clicking */
}
</style>
