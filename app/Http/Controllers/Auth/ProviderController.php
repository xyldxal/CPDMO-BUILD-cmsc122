<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\SystemUser;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Exception;
use GuzzleHttp\Client; //FOR TEMPORARILY DISBALING CERTIFICATE CHECKING
use Illuminate\Support\Facades\Hash;


class ProviderController extends Controller
{
    public function redirect($provider)
    {

        return Socialite::driver($provider)->with(['prompt' => 'select_account'])->redirect();
    }

    public function callback($provider)
    {
        try{
            if(Auth::check()){
                // dd($socialUser);
                $socialUser = Auth::user();
                
            } else {
                try {

                    //TEMPORARY DISABLE CERTIFACTE CHECKING
                    $guzzleClient = new Client([
                        'verify' => false, // Disable SSL verification
                    ]);

                    $socialUser = Socialite::driver('google')->stateless()->setHttpClient($guzzleClient)->user();
                    // Dump user information for debugging
                    // dd($user);
                } catch (\Exception $e) {
                    // Output the exception message and code for debugging
                    dd([
                        'error' => $e->getMessage(),
                        'code' => $e->getCode(),
                        'trace' => $e->getTraceAsString()
                    ]);
                }
                // $socialUser = Socialite::driver($provider)->stateless()->user();
                // dd($provider);
            }
            
        } catch (Exception $e){
            Session::flush();
            Auth::logout();
            // return Inertia::render('Home');
            return Redirect::to('/home');
        }

        // dd($socialUser);
        function sendRequest(){
            print "Please send request to this email with your college/unit, position, and UPMail (if not using UPMail yet).<br>";
        }

        if ($this->checkEmailInDB($socialUser->email)){
            // scenario 3 LOGIN (is in DB)
            try {
                $user = SystemUser::where('email', $socialUser->email)->first();
                Auth::login($user);
                // Authentication passed...
                // return Inertia::render('Dashboard');
                return redirect('/');
            } catch (Exception $e) {
                // return Inertia::render('Home');
                return redirect('/');
            }
             
        } else {
            if ($this->isUpMail($socialUser->email)){
                if ($details = $this->checkEmailinRT2($socialUser->email)){
                    // scenario 4 CREATE NEW ACCOUNT
                    if (empty($details->token)){
                        print "Your email is in the Reference Table but no designated 'role/position' has been added. <br>";
                        sendRequest();
                    }
                    $this->create($socialUser, $provider, $details);
                } else {
                    // scenario 2 EMAIL REQUEST
                    print "Email not in reference table. <br>";
                    sendRequest();
                }
            } else {
                // scenario 1 EMAIL REQUEST
                print "Email domain does not match that of @up.edu.ph of UPManila emails. Please log in using your UPMail or; <br>";
                sendRequest();
            }
        }
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function isUpMail($email) 
    {
        // Check if the email address ends with "@up.edu.ph" returns Boolean
        $domainToCheck1 = "@up.edu.ph";
        $domainToCheck2 = "@gmail.com";
        $emailDomain1 = substr($email, -strlen($domainToCheck1));
        $emailDomain2 = substr($email, -strlen($domainToCheck2));
    
        return strtolower($emailDomain1) === strtolower($domainToCheck1) || strtolower($emailDomain2) === strtolower($domainToCheck2);
    }

    public function checkEmailinRT($email)
    {
        $exists = DB::table('reference_table')
            ->where('email', $email)
            ->exists();

        if (!$exists) {
            return false;
        }
        return true;
    }

    public function checkEmailinRT2($email)
    {
        $referenceData = DB::table('reference_table')
            ->where('email', $email)
            ->select('token', 'unit', 'email', 'prefix')
            ->first();

        if ($referenceData) {
            // $role = $referenceData->role;
            // $unit = $referenceData->unit;

            return $referenceData;//"Role: $role, Unit: $unit";
        } else {
            return null;
        }
    }

    public function checkEmailInDB($email)
    {
        $exists = DB::table('system_users')
            ->where('email', $email)
            ->exists();

        if (!$exists) {
            return false;
        }
        return true;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($socialUser, $provider, $details)
    {
        function getRoleToken($role){
            $tokenMapping = [
                'adminsuperuser' => '20f1d5aa6a74ec3ec1225ac9abfd02678b9f82be23b81be8c5aaa2633982b9ad',
                'college-view-only' => '8ac96ea48f194503b6d86b94063653a984a6714eed45328a7f80cffa6b22acba',
                'college-crud' => '21ff9353b0fa0446bf3b8a4d0120104b866dd7bc9ec5fe2af1c32dce70684ded',
                'oil-crud' => 'e86b92f7835b7d8a87c5ac005ae746334fd83104ae627f18e062988ef2043299',
                'oil-coordinators' => '74da1da352bd03a9484c6799bff82d8dcdf108022715916978cf69e4704e3f7f',
                'our-crud' => 'c1a0305428dfb19036a12211be69be988cb2af182a9c7df4582e386437f687d8',
                'hrdo-crud' => '001ce434eb5d67ec6ed5886a6d5088c3150abed93aa403cc917c0df415ca8af7',
                'ovcaa-view-only' => 'f4fe0b0f4cb50c2df4b3c665161e7c65fa341b63b0d3a8913a9d41b855c6bb55',
                'ovcaa-crud' => '55397091d1ee80ea0dc1a4a3d517fe2c80483b25aadc22984bfa4e55c77a7acb',
                'ovcr-view-only' => '8435e3dbd73d8bc1b3c9ebe9e9a5abfe543d95b6ad3385496b0f2fb2c131c8b0',
                'ovcr-crud' => '7842e5f39ccd743e2bcb8cb4a3ad97dd20de141d7712c7ace02b1978b598af9b',
                'ovcpd-crud' => '7ee9ce402e4f6f601c330cfb4dafb3640bd5ab112c68b5a67b1aa09f467a4ed4',
                'ovca-view-only' => '2a603e7a60c1bebffb584aea57b4649e5e23311c776b842fb7941f3d300efd63',
                'ngohs' => '5c5ac98677f0833fe2caf332fbb7208158066cf475d7d269a7e41daf41912501',
                'ovcaf' => 'af7092543796483ee7803e92646274a91d7dee80e91bdc405577d15f384bf46c',
                'chancy' => '7570443b32f2449981229756f8289f6bf9a0d8c31aa229c175b85feb834d574c',
            ];
            return isset($tokenMapping[$role]) ? $tokenMapping[$role] : null;
        }
        // COMPLETE THE VARIABLES HERE FIRST
        $user = SystemUser::updateOrCreate([
            // 'provider_id' => $socialUser->id,
            
            'email' => $socialUser->email,
        ], [
            // 'user' => $socialUser->user,
            'provider' => $provider,
            'username' => $socialUser->name,##$socialUserUser->username
            'prefix' => $socialUser->name,
            'name' => $socialUser->name,
            'password' => Hash::make(bin2hex(random_bytes(30 / 2))),
            'picture_url' => $socialUser->avatar,
            'provider_token' => $socialUser->token,
            'token' => getRoleToken($details->token),
            'unit' => $details->unit,
            // 'refresh_token' => $socialUser->refresh_token,
        ]);
        // Auth::login($user);
        // dd($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
