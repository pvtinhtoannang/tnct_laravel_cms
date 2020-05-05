<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getAdminDashboard()
    {
        return view('admin.dashboard.dashboard-home');
    }
}
