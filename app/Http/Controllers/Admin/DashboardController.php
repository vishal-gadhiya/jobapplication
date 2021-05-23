<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Dashboard');
    }
}
