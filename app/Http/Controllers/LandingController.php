<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Flash;

class LandingController extends Controller
{
    public function index() {
        $projects = Project::where('status_publish','publish')->get();
        return view('landing.index',compact('projects') );
    }

    public function expertSystem($slug) {

        // $projects = Project::where('status_publish','publish')->get();

        $project = Project::where('slug',$slug)->first();
        return view('landing.expert',compact('project') );
       
    }
}
