<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
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

    // public function login(Request $request)
    // {   
    //     $input = $request->all();
  
    //     $this->validate($request, [
    //         'username' => 'required',
    //         'password' => 'required|min:8',
    //     ],[
    //         'username.required' => 'Kolom username atau email harus diisi'
    //     ]);

    //     // function messages()
    //     // {
    //     //     return [
    //     //         'username.required' => 'An Item Name is required',
    //     //         'password.required'  => 'An SKU NO is required',
    //     //     ];
    //     // }
  
    //     $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    //     if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
    //     {
    //         return redirect()->route('home');
    //     }else{
    //         return redirect()->route('login')
    //             ->with('error','Email-Address And Password Are Wrong.');
    //     }
          
    // }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username'    => 'required',
            'password' => 'required|min:8',
        ],[
            'username' => 'Kolom username atau password harus diisi'
        ]);

        $login_type = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL ) 
            ? 'email' 
            : 'username';

        $request->merge([
            $login_type => $request->input('username')
        ]);

        if (Auth::attempt($request->only($login_type, 'password'))) {
            return redirect()->intended($this->redirectPath());
        }

        return redirect()->back()
            ->withInput()
            ->withErrors([
                'username' => 'Data yang Anda masukkan tidak valid.',
            ]);
    } 

}



