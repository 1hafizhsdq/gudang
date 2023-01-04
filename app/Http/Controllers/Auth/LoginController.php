<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function username()
    {
        return 'username';
    }

    public function loginApi(Request $request){
        $res = Http::post('htk.test/api/login',[
            'headers' => [
                'Authorization' => 'Bearer ',
                'Accept' => 'application/json',
            ],
            'username' => $request->username,
            'password' => $request->password,
        ]);

        $response = json_decode($res->body());

        if($response->meta->code != 200){
            $this->sendFailedLoginResponse($request);
        }else{
            // create update data user
            $data = $response->data;
            $authUser = $this->findOrCreateUser($data->user,$data->access_token,$request->password);

            // attempt login
            Auth()->login($authUser, true);

            return redirect()->route('dashboard');
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function findOrCreateUser($body,$token,$password){
        $user = User::where('id',$body->id)->where('username',$body->username)->first();
        
        if (!$user) {
            User::create([
                'id' => $body->id,
                'name' => $body->name,
                'username' => $body->username,
                'email' => $body->email,
                'password' => Hash::make($password),
                'role' => $body->role,
                'foto' => $body->foto,
                'remember_token' => $token,
                'kategori_admin' => $body->kategori_admin
            ]);
        }else{
            User::where('id',$user->id)->update([
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'password' => Hash::make($password),
                'role' => $user->role,
                'foto' => $user->foto,
                'remember_token' => $token,
                'kategori_admin' => $body->kategori_admin
            ]);
        }

        $user = User::find($body->id);

        return $user;
    }

    // public function loged_out(Request $request){
    //     $res = Http::post('http://127.0.0.1:8081/api/logout', [
    //         'headers' => [
    //             'Authorization' => 'Bearer '. Auth::user()->remember_token,
    //             'Accept' => 'application/json',
    //         ],
    //     ]);

    //     $response = json_decode($res->body());

    //     if ($response->meta->code != 200) {
    //         return back();
    //     } else {
    //         $this->logout($request);
    //     }
    // }

    public function logout(Request $request)
    {
        // $res = Http::post('http://127.0.0.1:8081/api/logout', [
        //     'headers' => [
        //         'Authorization' => 'Bearer ' . Auth::user()->remember_token,
        //         'Accept' => 'application/json',
        //     ],
        // ]);

        // dd($res->body());
        // $response = json_decode($res->body());

        // if ($response->meta->code != 200) {
        //     return back();
        // } else {
            User::where('id',Auth::user()->id)->update(['remember_token' => null]);

            $this->guard()->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            if ($response = $this->loggedOut($request)) {
                return $response;
            }

            return $request->wantsJson()
            ? new JsonResponse([], 204)
                : redirect('/');
        // }
    }
}
