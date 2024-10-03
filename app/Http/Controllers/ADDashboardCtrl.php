<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ADDashboardCtrl extends Controller
{
    public function index(){
        $electionC = Election::all()->count();
        $teamC = Team::all()->count();
        $studentC = User::where('userType', "student")->count();
        $adminC = User::where('userType', "admin")->count();
        $user = auth()->user();
        $teamC = Team::all()->count();

        $elections = Election::latest()->limit(10)->get();

        $students = User::where('userType', 'student')->latest()->limit(8)->get();

        $elections = $elections->map(function($elec) {
            $teams = Team::where('election_id', $elec->id)->count();
            $elec->teamC = $teams;
            return $elec;
        });

        return view('pages.admin.dashboard', compact('user', 'electionC', 'teamC', 'studentC', 'adminC', 'elections', 'students'));
    }

    public function monthlyRecap(){
        $currentDate = Carbon::now();

        $sixMonthsAgo = $currentDate->subMonths(5)->startOfMonth();

        $months = [];

        for ($i = 0; $i < 6; $i++) {
            $month = $sixMonthsAgo->copy()->addMonths($i);
            $date = $month->format('Y-m');
            $months[] = [
                'elections' => Election::where('created_at', 'like', "$date%")->count(),
                'monthName' => $month->format('F'),
                'monthLabel' => $month->format('F, Y')
            ];
        }

        return response()->json($months);

    }
}
