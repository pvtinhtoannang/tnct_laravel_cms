<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Option;
use App\User;

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
        return view('admin.settings.options', ['options' => $option]);
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
