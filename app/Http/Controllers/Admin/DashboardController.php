<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function dashboard(): \Inertia\Response
    {
        return Inertia::render('Admin/Dashboard');
    }
}
