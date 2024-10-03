<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TeamCtrl extends Controller
{
    public function store(Request $request){
        try {
            $validated = $request->validate([
                'teamName' => 'required',
                'teamAdvocacy' => 'required'
            ]);

            $validated['election_id'] = $request->id;

            Team::create($validated);

            return back()->with('success', "New team added succesfully");
            
            } catch (ValidationException $err) {
                return back()->with('error', "Form validation error");
            }catch (Exception $err){
                return back()->with('error', "Someting went wrong");
            }
        }

        public function destroy(Request $request){
            try{
                Team::find($request->id)->delete();
                return back()->with('success', "Participants deleted succesfully");
            }catch(Exception $err){
                return back()->with('error', "Someting went wrong");
            }
        }
    }    
