<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\PasswordReset;
use App\Mail\TNCTEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ResetPasswordRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

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
     * @param Request $request
     */
    public function sendMail(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }

        return response()->json([
            'message' => 'Vui lòng kiểm tra email của bạn để đặt lại mật khẩu!'
        ]);
    }

    public function reset(Request $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'Đặt lại mật khẩu này không hợp lệ.',
            ], 422);
        }
        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $updatePasswordUser = $user->update($request->only('password'));
        $passwordReset->delete();

        return response()->json([
            'success' => $updatePasswordUser,
        ]);
    }


    //Kiểm tra email, tạo token
    public function postForgotPassword(Request $request)
    {
        //Tạo token và gửi đường link reset vào email nếu email tồn tại
        $result = User::where('email', $request->email)->first();
        if ($result) {
            $resetPassword = PasswordReset::firstOrCreate(['email' => $request->email, 'token' => Str::random(60)]);
            $token = PasswordReset::where('email', $request->email)->first();
            $link = url('reset-password') . "/" . $token->token; //send it to email
            $objEmail = new \stdClass();
            $objEmail->email = $request->email;
            $objEmail->link = $link;
            $objEmail->token = $token->token;
            Mail::to($request->email)->send(new TNCTEmail($objEmail));
            return true;
        } else {
            return false;
        }
    }

    public function getForgotPassword($token)
    {
        return $token;
        return view('themes.child-theme.components.pvtinh-new-password');
    }



    public function newPass(Request $request)
    {
        // Check password confirm
        if ($request->password == $request->confirm) {
            // Check email with token
            $result = ResetPassword::where('token', $request->token)->first();

            // Update new password
            User::where('email', $result->email)->update(['password' => bcrypt($request->password)]);

            // Delete token
            ResetPassword::where('token', $request->token)->delete();

            return redirect()->route('login');
        } else {
            echo "Password doesn't match";
        }

    }
}
