<?php

namespace App\Http\Controllers\BC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\BC\BackwardChaining;
use Auth;

class BcSettingController extends Controller
{
    public function index() {
        $sessionProject = Auth::user()->session_project;
        $backwardChainings = Project::find($sessionProject)->backwardChainings;

        return view('bc.settings.index', compact('backwardChainings'));
    }

    public function store(Request $request) {
        $backwardChainingId = $request->input('backward_chaining_id');
        BackwardChaining::where('id', $backwardChainingId)->update($request->except(['_token', 'backward_chaining_id']));
    
        return redirect()->route('bcSetting');
    }
    
}
