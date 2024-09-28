<?php

use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ProgressTrackerController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/greeting', function () {
    return 'Hello World';
});

/**
 * GOOGLE SSO OAUTH ROUTES
 */
Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

/**
 * ALL ROUTES RELATED TO LOGIN, SIGNUP, AND SSO ARE LISTED BELOW IN
 * THE SYSTEMUSERCONTROLLER.
 */
Route::controller(SystemUserController::class)->group(function () {
    // Route::get('/login', 'loginform');
    Route::get('/login', function () {
        // If the user is authenticated, redirect to the 'dashboard' route
        if (auth()->check()) {
            // return 'Logged In';
            return redirect('/home');
        } else {
            // return redirect('/nepp');
            // Route::get('log  in', [SystemUserController::class, 'store']);
            // return 'Not Logged in';
            return view('loginform');
        }
    
        // If the user is not authenticated, return the Inertia view for the home page
        // return Inertia('Home');
        
    });
    
    Route::post('/testform', [SystemUserController::class, 'logintest']);
    // Route::post('/testform', 'logintest');
});




/**
 * THE ROUTES BELOW WILL REDIRECT THE USER TO THE APPROPRIATE PAGES IF
 * THEY ARE ABLE TO LOG IN SUCCESSFULLY. IF THE SESSION EXPIRES, THEY 
 * SHALL BE REDIRECTED BACK TO LOGIN PAGE.
 */


Route::get('/home', function () {
    return auth()->check()
        ? app(ProgressTrackerController::class)->progressTrackers()
        : app(ProgressTrackerController::class)->index();
});

Route::get('/projects', function () {
    return auth()->check()
        ? app(ProgressTrackerController::class)->display_projects()
        : app(ProgressTrackerController::class)->index();
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [SystemUserController::class, 'logout'])->name('logout');
});

/**
 * ROUTE REDIRECTS FOR WHEN AN EMPTY ROUTE IS BEING ACCESSED
 */
Route::get('/', function () {
    // If the user is authenticated, redirect to the 'dashboard' route
    if (auth()->check()) {
        return redirect('/home');
    } else {
        // return redirect('/nepp');
        return redirect('/login');
    }

    // If the user is not authenticated, return the Inertia view for the home page
    // return Inertia('Home');
    
});