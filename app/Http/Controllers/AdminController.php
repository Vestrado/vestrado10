<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_admin) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }
            Auth::logout();
            return back()->withErrors(['email' => 'You are not an admin.']);
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function dashboard()
    {
        $pendingorder = DB::connection('vestrado')->table('orders')
        ->whereIn('status', ['Pending', 'Ordered', 'Processing', 'Shipping'])
        ->count();

        $ttl_order = DB::connection('vestrado')->table('orders')->count();

        $allproducts = DB::connection('vestrado')->table('product')->count();

        return view('admin.dashboard2', [
            'pendingorder' => $pendingorder,
            'ttl_order' => $ttl_order,
            'allproducts' => $allproducts,
        ]);
        //return view('admin.dashboard2');
    }
}
