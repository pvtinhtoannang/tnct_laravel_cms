<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Option;
use App\User;
use Illuminate\Support\Facades\Auth;

class OptionController extends Controller
{
    protected $option, $user;

    public function __construct()
    {
        $this->option = new Option();
        $this->user = new User();
    }

    public function getOptionGeneral()
    {
        $this->user->authorizeRoles('option_general');
        $option = $this->option->getAllOption();
        return Carbon::now()->addDays(30);
        return $this->user->registerPostForUser(Auth::user()->id, 2, strtotime(Carbon::now()));


        return view('admin.settings.options', ['options' => $option]);
    }

    public function postAddOptionGeneral(Request $request)
    {
        $option_label = $request->option_label;
        $option_value = $request->option_value;
        $option_name = $request->option_name;
        $option_type = $request->option_type;

        if (!empty($option_label) && !empty($option_value) && !empty($option_name) && !empty($option_type)) {
            if($this->option->addNewOption($option_name, $option_value, $option_type, $option_label)){
                return redirect()->back()->with('messages', 'Cập nhật thành công!');
            }else{
                return redirect()->back()->with('messages', 'Cập nhật không thành công!');
            }
        }
    }

    public function postUpdateOptionGeneral(Request $request)
    {
        foreach ($request->option as $value) {
            foreach ($value as $option_name => $option_value) {
                \App\Option::where('option_name', $option_name)
                    ->update(['option_value' => $option_value]);
            }
        }
        return redirect()->back()->with('messages', 'Cập nhật thành công!');
    }
}
