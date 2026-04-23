<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (session('user_role') !== 'admin') {
            return redirect()->route('login')->with('error', 'Silakan login sebagai admin');
        }

        return view('admin.dashboard');
    }
}