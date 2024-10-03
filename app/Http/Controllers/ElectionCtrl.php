<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Participant;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ElectionCtrl extends Controller
{
    public function index(){
        $user = auth()->user();
        $elections = Election::all();
        
        return view('pages.admin.elections', compact('user', 'elections'));
    }

    public function manageElection(Request $request){
        $user = auth()->user();
        
        $election = Election::with('teams')->find($request->id);

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
        
        $teams = $election->teams->map(function($team) use($positions) {
            $participants = Participant::where('team_id', $team->id)->get();
        
           $proccessedPart = [];
        
            foreach ($positions as $position) {
                $participant = $participants->firstWhere('position', $position);
                
                if($participant){
                $participant->hasParticipant = true;                 
                $proccessedPart[$position] = $participant; 
                }else{
                $proccessedPart[$position] = (object) ['position' => $position, 'hasParticipant' => false];
                }

            }

            $team->participants = $proccessedPart;
        
            return $team;
        });
        
        
        
        return view('pages.admin.manageElection', compact('user', 'election', 'positions'));
    }

    public function updateElection(Request $request){
        try {
            $validated = $request->validate([
                'electionName' => 'required',
                'startAt' => 'required',
                'endAt' => 'required',
            ]);

           $election = Election::find($request->id);

           if($election){
                $election->update($validated);
           }

            return back()->with('success', "New election succesfully added");
         
        } catch (ValidationException $err) {
            return back()->with('error', "Form validation error");
        }catch (Exception $err){
            return back()->with('error', "Someting went wrong");
        }
    }

    public function destroy(Request $request){
        try {
    
            $election = Election::find($request->id)->delete();

            return redirect('/administrator/elections')->with('success', "Election deleted succesfully");
         
        }catch (Exception $err){
            return back()->with('error', "Someting went wrong");
        }
    }

    public function store(Request $request){
      
        try {
            $validated = $request->validate([
                'electionName' => 'required',
                'startAt' => 'required',
                'endAt' => 'required',
            ]);


            $newElection = Election::create($validated);

            return redirect(route('manage-election', ['id' => $newElection->id]))->with('success', 'New election successfully added');
         
        } catch (ValidationException $err) {
            return back()->with('error', "Form validation error");
        }catch (Exception $err){
            return back()->with('error', "Someting went wrong");
        }
    }
    public function showAnalysis(Request $request){
        $user = auth()->user();
        $election = Election::find($request->id);
        return view('pages.admin.voteAnalysis', compact('user', 'election'));
    }

    public function analysisData(Request $request){

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
        
        return response()->json($participants);
    }
}
