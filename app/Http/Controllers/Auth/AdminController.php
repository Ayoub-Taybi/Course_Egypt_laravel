<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;





class AdminController extends Controller
{


    use AuthenticatesUsers;


    protected $redirectTo = RouteServiceProvider::ADMIN;


    public function adminLogin(){

        return view('auth.adminLogin');

    }


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

   
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function checkAdminLogin(Request $request){

        // dd($this->getMiddleware());

        $request->validate([
             'email' => 'required|email',
             'password' => 'required|string',
        ]);
       
        // if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
           
        //     return redirect()->intended('/admin');
        // }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);


    }

    public function logout(Request $request)
    {

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');

    }

    


}
