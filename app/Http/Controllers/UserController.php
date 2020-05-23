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

    public function getLoginSocialGuide()
    {
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
        if (!session()->has('pre_url')) {
            session()->put('pre_url', URL::previous());
        } else {
            if (URL::previous() != URL::to('/')) session()->put('pre_url', URL::previous());
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
        if ($checkEmail) {
            return $checkEmail;
        }
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }


    public function getMyAccountPage()
    {
        $titleWebsite = new ThemeController();
        $title = $titleWebsite->getTitleWebsite('tai-khoan');
        if (Auth::check()) {
            $name_avatar_text = explode(' ', Auth::user()->name);
            $name_last = $name_avatar_text[sizeof($name_avatar_text) - 1];
            return view('themes.child-theme.components.mn-khkt-my-account', ['titleWebsite' => $title, 'avatar_text' => substr($name_last, 0, 1)]);
        } else {
            abort('401');
        }
    }


    public function updatePasswordForFrontEnd(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $password_confirm = $request->password_confirm;
        $authUser = User::where('email', $email)->first();

        if ($authUser) {
            if ($password === $password_confirm && !empty($password_confirm) && !empty($password)) {
                $this->user->updatePassword($password, 0, $email);
                return redirect()->back()->with('messages', 'Đã cập nhật mật khẩu mới');
            } else {
                return redirect()->back()->with('errors', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại thông tin!');
            }
        }
    }

    public function getMyCourse(){
        $user = Auth::user();
        $post = $user->postsCourses;
        $titleWebsite = new ThemeController();
        $title = $titleWebsite->getTitleWebsite('khoa-hoc');
        return view('themes.child-theme.components.mn-khkt-my-courses', ['course'=>$post, 'titleWebsite'=>$title]);
    }
}
