<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class LandingController extends Controller
{
    public function index() {
        $projects = Project::where('status_publish','publish')->get();
        return view('landing.index',compact('projects') );
    }
}
