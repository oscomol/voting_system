<?php

use App\Http\Controllers\ADDashboardCtrl;
use App\Http\Controllers\ADStudentCtrl;
use App\Http\Controllers\AuthCtrl;
use App\Http\Controllers\ElectionCtrl;
use App\Http\Controllers\ParticipantsCtrl;
use App\Http\Controllers\StudentCtrl;
use App\Http\Controllers\StudentVCtrl;
use App\Http\Controllers\TeamCtrl;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('pages.auth.login');
});

Route::match(['GET', 'POST'],'/login', [AuthCtrl::class,'login'])->name('login');

Route::match(['GET', 'POST'],'/login/admin', [AuthCtrl::class,'login'])->name('login');

Route::get('/logout', [AuthCtrl::class, 'logout'])->name('logout');
Route::get('/account/delete/{studentId}', [StudentCtrl::class, 'destroy']);

Route::get('/register', function () {
    return view('pages.auth.register');
});

Route::post('/register/student', [StudentCtrl::class, 'store'])->name('register-student');

Route::group(['middleware' => 'auth'], function() {

    Route::middleware(['checkRole:student'])->group(function() {
        Route::get('/student', [StudentVCtrl:: class, 'index']);
        Route::get('/student/election/{id}', [StudentVCtrl:: class, 'showElection']);

        Route::put('/update/student/{studentId}', [StudentCtrl::class, 'update'])->name('student-update');

    });

    Route::middleware(['checkRole:admin'])->group(function() {

        //DASHBOARD
        Route::get('/administrator/dashboard', [ADDashboardCtrl::class,  'index']);
        Route::get('/administrator/monthlyrecap', [ADDashboardCtrl::class,  'monthlyRecap']);

        //ELECTIONS ROUTE
        Route::get('/administrator/elections', [ElectionCtrl::class, 'index']);
        Route::get('/administrator/elections/{id}', [ElectionCtrl::class, 'manageElection'])->name('manage-election');


        Route::get('/administrator/elections/analysis/{id}', [ElectionCtrl::class, 'showAnalysis']);
        Route::get('/administrator/elections/analysis/getData/{id}', [ElectionCtrl::class, 'analysisData']);

        Route::post('/elections/add', action: [ElectionCtrl::class, 'store'])->name('add-election');
        
        Route::put('/administrator/elections/update/{id}', [ElectionCtrl::class, 'updateElection'])->name('election-update');
        Route::delete('/administrator/elections/delete/{id}', [ElectionCtrl::class, 'destroy'])->name('election-delete');

        //ELECTION TEAM
        Route::post('/team/add/{id}', action: [TeamCtrl::class, 'store'])->name('add-team');
        Route::delete('/team/delete/{id}', action: [TeamCtrl::class, 'destroy'])->name('delete-team');

        //PARTICIPANTS
        Route::post('/team/participant/{id}', action: [ParticipantsCtrl::class, 'store'])->name('add-participant');
        Route::delete('/participant/delete/{id}', action: [ParticipantsCtrl::class, 'destroy'])->name('participant-delete');

        //Student
        Route::get('/administrator/students', [ADStudentCtrl:: class, "index"]);
        Route::post('/administrator/student/reset-password/{id}', action: [StudentCtrl::class, 'resetPassword'])->name('reset.password');
    });
});