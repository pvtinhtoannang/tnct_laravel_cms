<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;
class UserController extends Controller
{
    protected $user, $role;

    public function __construct()
    {
        $this->user = new User();
        $this->role = new Role();
    }

    public function getMyProfile(Request $request)
    {
//        $request->user()->authorizeRoles(['administrator']);
        return view('admin.users.my-profile');
    }


    public function updateMyProfile(Request $request)
    {
        $password = $request->password;
        $email = Auth::user()->email;
        $this->user->updateInformation($request->name, $email, Auth::user()->id);
        if (!empty($request->email) && !$this->user->checkEmailExists($request->email)) {
            //thay đổi email
            if (!empty($password)) {
                $this->user->updatePassword($request->password, 0, $email);
                return redirect()->back()->with('messages', 'Cập nhật thành công!');
            }
        } elseif (!empty($password)) {
            if (strlen($password) < 8) {
                return redirect()->back()->with('messages', 'Mật khẩu quá ngắn!');
            } else {
                $this->user->updatePassword($request->password, 0, $email);
                return redirect()->back()->with('messages', 'Đổi mật khẩu thành công!');
            }
        } else {
            return redirect()->back()->with('messages', 'Cập nhật thông tin thành công!');
        }
    }

    public function getLoginSocialGuide(){
        return view('admin.users.login-social-guide');
    }

    /**
     * lấy thông tin user
     * @param $id
     * Dùng cho ajax ajax-get-user-by-id
     * @return collect
     */
    public function getUserByID($id)
    {
        $role = $this->user->getUserbyID($id)->roles;
        $user = $this->user->getUserbyID($id);
        return collect([$role, $user]);
    }

    public function getAllUser()
    {
        $data_user = $this->user->getAllUser();
        $data_role = $this->role->getAllRole();
        return view('admin.users.all-user', ['dataUsers' => $data_user, 'dataRole' => $data_role]);
    }

    public function addNewUser(Request $request)
    {
        if (!empty($request->name) && !empty($request->email) && !empty($request->password)) {
            if ($this->user->checkEmailExists($request->email)) {
                return redirect()->back()->with('messages', 'Email đã tồn tại!');
            } else {
                $user = $this->user->addNewUser($request->name, $request->email, $request->password, $request->role_id);
            }
            return redirect()->back()->with('messages', 'Cập nhật thông tin thành công!');
        } else {
            return redirect()->back()->with('messages', 'Cập nhật thông tin thất bại!');
        }
    }


    public function updateUserByList(Request $request)
    {
        $id = $request->update_id;
        $password = $request->password;
        $name = $request->name;
        $email_new = $request->email;
        $role_id = $request->role_id;
        $email_old = $this->user->getUserbyID($id)->email;
        $this->user->updateRoleByUserID($id, $role_id);


        if (!empty($password) && !empty($name) && !empty($email_new)) {
            $this->user->updatePassword($request->password, $id, '');
            if (!$email_old !== $email_new) {
                if (!$this->user->checkEmailExists($email_new)) {
                    $this->user->updateInformation($name, $email_new, $id);
                    return redirect()->back()->with('messages', 'Cập nhật thành công!');
                } else {
                    return redirect()->back()->with('messages', 'Cập nhật thất bại, email này đã tồn tại!');
                }
            } else {
                $this->user->updateInformation($name, $email_old, $id);
                return redirect()->back()->with('messages', 'Cập nhật thành công!');
            }
        } else {
            if (!empty($name) && !empty($email_new)) {
                if (!$this->user->checkEmailExists($email_new)) {
                    $this->user->updateInformation($name, $email_new, $id);
                    return redirect()->back()->with('messages', 'Cập nhật thành công!');
                } else {
                    return redirect()->back()->with('messages', 'Cập nhật thất bại, email này đã tồn tại!');
                }
            } else {
                return redirect()->back()->with('messages', 'Vui lòng nhập thông tin!');
            }
        }
    }


    /**
     * Chuyển hướng người dùng sang OAuth Provider.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        if(!session()->has('pre_url')){
            session()->put('pre_url', URL::previous());
        }else{
            if(URL::previous() != URL::to('/')) session()->put('pre_url', URL::previous());
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Lấy thông tin từ Provider, kiểm tra nếu người dùng đã tồn tại trong CSDL
     * thì đăng nhập, ngược lại nếu chưa thì tạo người dùng mới trong SCDL.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return Redirect::to(session()->get('pre_url'));
    }

    /**
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        $checkEmail = User::where('email', $user->email)->first();
        if($checkEmail){
            return $checkEmail;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
}
