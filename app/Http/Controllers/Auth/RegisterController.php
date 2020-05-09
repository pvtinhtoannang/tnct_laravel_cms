<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/tai-khoan';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function registerForUser(Request $request){
        $rules = [
            'name' => ['required', 'string', 'max:190'],
            'email' => ['required', 'string', 'max:190', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required|min:8'
        ];
        $messages = [
            'name.required' => 'Vui lòng điền họ và tên của bạn!',
            'name.string' => 'Tên của bạn phải là ký tự!',
            'name.max' => 'Tên của bạn quá dài, vui lòng kiểm tra lại!',
            'email.required' => 'Email không được để trống!',
            'email.string' => 'Email phải là ký tự!',
            'email.max' => 'Email quá dài, vui lòng kiểm tra lại!',
            'email.unique' => 'Email này đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.string' => 'Mật khẩu phải bao gồm số, ký tự',
            'password.min' => 'Mật khẩu phải từ 8 ký tự trở lên',
            'password.confirmed' => 'Mật khẩu xác nhận chưa đúng',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()], 500);
        } else {
            $name = $request->name; $email = $request->email; $password = $request->password;
            if(User::registerUser($name, $email, $password)){
                return 'Ok';
            }else{
                return 'False';
            }
        }
    }
}
