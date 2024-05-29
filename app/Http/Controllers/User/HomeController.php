<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function dashboard(Request $request): \Inertia\Response
    {
        return Inertia::render('Dashboard', ['user' => $request->user()]);
    }
}
