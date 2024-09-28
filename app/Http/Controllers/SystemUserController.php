<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\SystemUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SystemUserController extends Controller
{
    public function index(){
        return Inertia::render('index', [
            'system_users'=>SystemUser::all()->map(function($systemuser){
                return [
                    'id'=>$systemuser->id,
                    'username'=>$systemuser->username,
                    'password'=>$systemuser->password,
                    'token'=>$systemuser->token,
                    'unit'=>$systemuser->unit,
                ];
            })
        ]);
    }
    public function loginform()
    {
        return view('loginform');
        // return 'Hello World';
    }

    public function logintest(Request $request)
    {
        // dd($request);
        // return 'SUB MIT TED';
        // return view('welcome');
        // return response()->json(['message' => 'Validation passed and data processed'], 207);
        try{
            $validated = $request->validate([
                'email' => 'required|email|string|max:255',
                'password' => 'required|string|max:255',
            ]);
        } catch (Exception $e) {
            // return view('welcome');
            return response()->json(['message' => 'Validation error'], 507);
        }
        return response()->json(['message' => 'Validation passed and data processed'], 207);

        // Process the form data
        // For example, save to the database or send an email

        // Return a response, such as a redirect or a view
        // dd($validated);
        // return 'Hello World by: '.$request->name;
        // return view('welcome');
        // return redirect()->back()->with('success', 'Form submitted successfully!');
    }

    public function create(){
        return inertia::render('create');
    }

    public function store(Request $request){

        $validated=$request->validate([ ##system_users is the table name
            // 'username'=>'required|max:255|unique:App\Models\SystemUser,username',
            'email'=>'required|email|max:255|unique:App\Models\SystemUser,email',
            'password'=>'required|max:30|min:4',
            'token'=>'required|max:255',
            'unit'=>'required|max:255',
        ]);

        SystemUser::create($validated);

        return Redirect::route('systemusers.index');
    }

    // Function that will return a role
    public function chooseRole(Request $request){
        
        return true;
    }

    public function login(Request $request){
        // return response()->json($request);
        try {
            
            
            $jsonData = json_decode($request->getContent(), true);
            $jsonString = $jsonData['body'];
            $data = json_decode($jsonString, true);
            $email = $data['email'];

            $credentials = [
                'email' => $data['email'],
                'password' => $data['password'],
            ];

            // $user = SystemUser::where('email', $email)->first();

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                $token = Auth::user()->createToken('authToken')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'token' => $token,
                ]);
            } else {
                $queries = DB::getQueryLog();
                // print_r($queries);
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credential2s',
                    'credentials' => $credentials,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed: ' . $e->getMessage(),
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();

        // If using Inertia.js, return a response with the Inertia redirect
        // return Inertia::render('Dashboard');
        return redirect('/');
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    public function getUser()
    {
        $user = Auth::user();
        return $user;
    }

    public function nepnep()
    {
        try {
            DB::connection()->getPdo();
            return 'Connected to the database successfully!';
        } catch (\Exception $e) {
            return 'Failed to connect to the database: ' . $e->getMessage();
        }
    }

    // Create new user based on Social Login details. Required: Choose role function first
    public function storeSocialLogData(Request $request){

        $validated=$request->validate([ ##system_users is the table name
            'email'=>'required|max:255|unique:App\Models\SystemUser,email',
            'username'=>'max:255|unique:App\Models\SystemUser,username',
            'prefix'=>'max:20',
            'name'=>'max:30|min:4',
            'password'=>'required|min:4|max:255',
            'provider'=>'max:255',
            'picture_url'=>'max:255',
            'provider_token'=>'required|max:255',
            'token'=>'required|max:255',
            'unit'=>'required|max:255',
            'remember_token'=>'max:255',
        ]);

        SystemUser::create($validated);

        return Redirect::route('systemusers.index');
    }

    // Check if user is in main system_users table
    public function checkEmailInDB($email){
        try {
            $validatedData = $request->validate([
                'email' => [
                    'required',
                    'max:255',
                    Rule::exists('system_users', 'email'),
                ],
            ]);
            return true;
        } catch (ValidationException $e) {
            return false;
        }
    }

    // Check if user is in Reference Table
    
}
