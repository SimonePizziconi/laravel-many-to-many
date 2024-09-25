<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {

        $n_project = Project::count();
        return view('admin.dashboard', compact('n_project'));
    }
}
