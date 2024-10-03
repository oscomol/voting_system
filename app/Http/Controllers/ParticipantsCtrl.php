<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ParticipantsCtrl extends Controller
{
    public function store(Request $request){
        try {

            $validated = $request->validate([
                'participantsName' => 'required',
                'participantsAdvocacy' => 'required',
                'position' => 'required',
            ]);

            $isExist = Participant::where('team_id', $request->id)
            ->where('position', $validated['position'])->first();

            if($isExist){
                $file= $request->file('photo');
                if($file){
                    $filename = date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('participants/image'), $filename);
                    $validated["photo"] = $filename;
                }

                $isExist->update($validated);
                return back()->with('success', "Participants updated succesfully");
            }else{
                
            $file= $request->file('photo');
            
            if($file){
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('participants/image'), $filename);
                $validated["photo"] = $filename;
                $validated['team_id'] = $request->id;
            }else{
                return back()->with('error', "Form validation error- (No Photo attach)");
            }

            Participant::create($validated);

            return back()->with('success', "Participants added succesfully");
           
            }

         
        } catch (ValidationException $err) {
            return back()->with('error', "Form validation error");
        }catch (Exception $err){
            return back()->with('error', "Someting went wrong");
        }
    }

    public function destroy(Request $request){
        try{
            Participant::find($request->id)->delete();
            return back()->with('success', "Participants deleted succesfully");
        }catch(Exception $err){
            return back()->with('error', "Someting went wrong");
        }
    }
}
