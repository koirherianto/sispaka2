<?php

namespace App\Http\Controllers\BC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BcResult;
use App\Models\Project;
use App\Models\BcFact;
use App\Models\BcQuestion;
use Flash;
use Auth;

// Mencoba Backward chaining Controller
class TryBcController extends Controller
{
    //yang pertama pilih result dari backward chaining
    public function selectResults() {
        $sessionProject = Auth::user()->session_project;
        $backwardChainings = Project::find($sessionProject)->backwardChainings;
        $bcResults = $backwardChainings->bcResults;

        return view('bc.try.select_result')->with('bcResults', $bcResults);
    }

    // yang kedua tampilkan pertanyaan dari result yang dipilih
    public function selectQuestion(Request $request) {
        //ini kurang aman seharusnya di samakan dengan session project
        $bcQuestions = BcQuestion::where('bc_result_id',$request->bc_result_id)->get();

        return view('bc.try.select_questions')->with('bcQuestions', $bcQuestions);
    }

    // yang ketiga tampilkan hasil dari pertanyaan yang dipilih
    public function results(Request $request) {
        return $request->all();
    }
}
