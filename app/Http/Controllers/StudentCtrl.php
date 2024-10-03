<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\ApiException;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Session;
class StudentCtrl extends Controller
{

    public function sendSms($phone, $user){
        $configuration = new Configuration(
            host: '4emzv6.api.infobip.com',
            apiKey: '41dfe8848527199794ad52f17216be45-48f1645c-9951-4043-ab32-67ea552498d9'
        );

        $sendSmsApi = new SmsApi(config: $configuration);

        // '639949724199'

    $message = new SmsTextualMessage(
        destinations: [
            new SmsDestination(to: $phone)
        ],
        from: 'Me',
        text: "Hai $user, you have succesfully registered to SCHOOLNAME voting system."
    );

    $request = new SmsAdvancedTextualRequest(messages: [$message]);

    try {
        $smsResponse = $sendSmsApi->sendSmsMessage($request);
       
    } catch (ApiException $apiException) {
        // HANDLE THE EXCEPTION
    }
       
    }

    public function store(Request $request){
        try {
            $validated = $request->validate([
                'phone' => 'required|numeric',
                'lrn' => 'required|numeric',
                'name' => 'required',
                'userType' => 'required',
                'password' => 'required|confirmed'
            ]);
            
            $validated['password'] = Hash::make($validated['password']);
    
            $newUser = User::create($validated);
    
            if($newUser){
                $this->sendSms($validated['phone'], $validated['name']);
                $user = [
                    'lrn' => $request->lrn,
                    'password' => $request->password
                ];
    
                if (Auth::attempt($user)) {
                    if(auth()->user()->userType === "student"){
                        return redirect('/student')->with("message", "Account created succesfully");
                       }else{
                        dd("admin");
                    }
                }
            }

        } catch (ValidationException $err) {
            return back()->withErrors($err->errors())->withInput();
        }catch (Exception $err){
            return back()->withErrors("LRN already used");
        }
    }

    public function update(Request $request){
        try {

            $validated = $request->validate([
                'phone' => 'required|numeric',
                'lrn' => 'required|numeric',
                'name' => 'required',
            ]);
            

            $userUpdate = User::find($request->studentId);

            if($userUpdate){
                if($request->password){
                    $validated['password'] = Hash::make($request->password);
                }
                $userUpdate->update($validated);
            }

            return back()->with("message", "Account updated succesfully");

        }catch (Exception $err){

            return back()->with("error", "Something went wrong.");
        }
    }

    public function destroy(Request $request){
        try {

            $userUpdate = User::find($request->studentId);

            if($userUpdate){
                $userUpdate->delete();
            }

            return redirect(route('logout'));

        }catch (Exception $err){
            
            return back()->with("error", "Something went wrong.");
        }
    }

    public function resetPassword(Request $request){
        try {

            $user = User::find($request->id);

            $user->password = Hash::make("123");

            $user->update();

            return back()->with("message", "Password for user: $user->name was updated to 123");

        }catch (Exception $err){
            
            return back()->with("error", "Something went wrong while reseting password.");
        }
    }
}
