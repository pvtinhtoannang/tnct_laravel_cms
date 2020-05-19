<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
        $this->user = new User();
    }

    public function getLogin()
    {
        return view('admin.login.login');
    }

    /**
     * Where to redirect users after login.
     *
     *
     */
    public function redirectTo()
    {

        $role = $this->user->getNameRole(Auth::user()->id);
        switch ($role[0]->name) {
            case 'administrator':
            case 'editor':
            case 'author':
            case 'contributor':
            case 'shop_manager':
            case 'seo_manager':
            case 'seo_editor':
                return '/admin';
                break;
            case 'customer':
            case 'subscriber':
            default:
                return '/';
                break;
        }
    }


    public function postLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password], $request->has('remember'))) {
            return $this->redirectTo();
        } else {
            return $data['messages'] = 'Tài khoản hoặc mật khẩu không đúng!';
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
