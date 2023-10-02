<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Flash;

class LandingController extends Controller
{
    public function index() {
        $projects = Project::where('status_publish','publish')->get();

        $seoDescription = 'Buat Sistem Pakar Anda Sendiri: Buatlah keputusan yang lebih cerdas dan efisien dengan aplikasi kami yang memungkinkan Anda untuk merancang sistem pakar khusus tanpa kode.'; 
        $seoTitle = 'Buat Sistem Pakar';
        $seoKeyword = 'sistem pakar, kecerdasan buatan, pengambilan keputusan, solusi cerdas, aplikasi pengembangan sistem pakar, buat sistem pakar, platform sistem pakar';
        return view('landing.index',compact('projects','seoDescription','seoTitle','seoKeyword'));
    }

    public function expertSystem($slug) {
        $project = Project::where('slug',$slug)->first();

        $seoDescription = $project->short_description; 
        $seoTitle = $project->title;
        $seoKeyword = $project->tag_keyword;

        return view('landing.expert',compact('project','seoDescription','seoTitle','seoKeyword'));
       
    }
}
