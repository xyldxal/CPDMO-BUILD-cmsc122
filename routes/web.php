<?php

use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ProgressTrackerController;
use App\Http\Controllers\OVCPDProgressTrackerController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProjectController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        
    })->name('login');
    
    Route::post('/testform', [SystemUserController::class, 'logintest']);
    // Route::post('/testform', 'logintest');
});




/**
 * THE ROUTES BELOW WILL REDIRECT THE USER TO THE APPROPRIATE PAGES IF
 * THEY ARE ABLE TO LOG IN SUCCESSFULLY. IF THE SESSION EXPIRES, THEY 
 * SHALL BE REDIRECTED BACK TO LOGIN PAGE.
 */


// Route::get('/home', function () {
//     return auth()->check()
//         ? app(ProgressTrackerController::class)->progressTrackers()
//         : app(ProgressTrackerController::class)->index();
// });

Route::get('/home', [ProgressTrackerController::class, 'handleHome']);

Route::get('/projects', function () {
    return auth()->check()
        ? app(ProgressTrackerController::class)->display_projects()
        : app(ProgressTrackerController::class)->index();
});

// Route::middleware(['auth'])->group(function () {
//     Route::post('/upload/{type}', [FormController::class, 'bulk'])->name('bulk.upload');
//     Route::get('/display/{type}', [FormController::class, 'display'])->name('display');
//     Route::post('/form/add/{type}', [FormController::class, 'store'])->name('store');
//     Route::delete('/form/delete/{type}/{id}', [FormController::class, 'destroy'])->name('destroy');
//     Route::get('/form/show/{type}/{id?}', [FormController::class, 'show'])->name('show');
//     Route::post('/form/update/{type}/{id}', [FormController::class, 'update'])->name('update');    
// });

Route::middleware(['auth'])->group(function () {
    //PROJECT TRACKER ROUTES
    Route::post('/form/add/ProjectTracker', [OVCPDProgressTrackerController::class, 'store'])->name('store_tracker');
    Route::delete('/form/delete/ProjectTracker/{id}', [OVCPDProgressTrackerController::class, 'destroy'])->name('destroy_tracker');
    Route::get('/form/show/ProjectTracker/{id?}', [OVCPDProgressTrackerController::class, 'show'])->name('show_tracker');
    Route::post('/form/update/ProjectTracker/{id}', [OVCPDProgressTrackerController::class, 'update'])->name('update_tracker');  
    Route::get('/MasterPlan/c/JSON', [OVCPDProgressTrackerController::class, 'getJson'])->name('getPlanJSON');  
    Route::post('/form/upload/Plan', [OVCPDProgressTrackerController::class, 'bulk'])->name('bulk');  

    //PROJECT ROUTES
    // Route::post('/upload/Project', [ProjectController::class, 'bulk'])->name('bulk.upload');
    // Route::get('/display/Project', [ProjectController::class, 'display'])->name('display');
    Route::post('/form/add/Project', [ProjectController::class, 'store'])->name('store');
    Route::delete('/form/delete/Project/{id}', [ProjectController::class, 'destroy'])->name('destroy');
    Route::get('/form/show/Project/{id?}', [ProjectController::class, 'show'])->name('show');
    Route::post('/form/update/Project/{id}', [ProjectController::class, 'update'])->name('update');  
    Route::post('/form/upload/Project', [ProjectController::class, 'bulk'])->name('bulk');  
    Route::get('/ProgressTracker/c/JSON', [ProgressTrackerController::class, 'getJson'])->name('getProjectJSON');  
});


Route::get('/ongoing-projects', function () {
    return auth()->check()
        ? app(ProgressTrackerController::class)->ongoing_projects()
        : app(ProgressTrackerController::class)->index();
});

Route::get('/about', [AboutController::class, 'index']);

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