<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ADStudentCtrl extends Controller
{
    public function index (){
        $students = User::where('userType', 'student')->get();
        $user = auth()->user();
        return view('pages.admin.students', compact('user', 'students'));
    }
}
