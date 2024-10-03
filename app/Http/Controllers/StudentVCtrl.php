<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Participant;
use App\Models\Team;
use Illuminate\Http\Request;

class StudentVCtrl extends Controller
{
    public function index(){
        $user = auth()->user();
        $elections = Election::all();
        return view('pages.student.index', compact('user', 'elections'));
    }

    public function showElection(Request $request){

        $user = auth()->user();
        $election = Election::find($request->id);

        $teams = Team::where("election_id", $request->id)->get();
        
        $positions = [
            "President",
            "Vice President",
            "Secretary",
            "Treasurer",
            "Auditor",
            "PIO",
            "Protocol Officer",
            "Grade 7 Representative",
            "Grade 8 Representative",
            "Grade 9 Representative",
            "Grade 10 Representative",
            "Grade 11 Representative",
            "Grade 12 Representative",
        ];

        $participants = [];

        if($teams->count() > 0){
            foreach($positions as $position){
                foreach($teams as $team){
                    $participant = Participant::where('position', $position)->where('team_id', $team->id)->first();
                    
                    if ($participant) {
                        $team = $teams->firstWhere('id', $participant->team_id);
                        $participant->team = $team;
                        $participants[$position][] = $participant;
                    } else {
                        $participants[$position][] = null;
                    }
                }
            }
        }

     
        return view('pages.student.election', compact('user', 'election', 'participants'));
    }
}
