<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLoginForm(): \Inertia\Response
    {
        return Inertia::render('Admin/Auth/Login');
    }

    public function login(AdminAuthRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (Auth::attept(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            return redirect()->route('admin.dashboard')->with('success', 'You successfully logined');
        }

        return redirect()->back()->with('error', 'Invalid credentials!');
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect()->route('admin.login');
    }
}
