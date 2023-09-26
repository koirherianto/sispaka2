<?php

namespace App\Http\Controllers\BC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BC\BcResult;
use App\Models\Project;
use App\Models\BC\BcFact;
use App\Models\BC\BcQuestion;
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
    // public function results(Request $request) {
    //     //semua pertanyaan
    //     $bcQuestions = BcQuestion::find($request->bcQuestion[0])->bcResult->bcQuestions->load('bcFact');
    //     //pertanyaan yang dipilih
    //     $bcQuestionCheckBoxs = [];
    //     foreach ($request->bcQuestion as $key => $value) {
    //         $bcQuestionCheckBox = BcQuestion::find($value)->load('bcFact');
    //         $bcQuestionCheckBoxs[] = $bcQuestionCheckBox;
    //     }


    //     if (empty($request->bcQuestion)) {
    //         Flash::error('Choose at least one question');
    //         return redirect(route('trybc.selectResult'));
    //     }

    //     $bcFactsValueAll = 0;
    //     $bcQuestions = BcQuestion::find($request->bcQuestion[0])->bcResult->bcQuestions->load('bcFact');
    //     foreach ($bcQuestions as $value) {
    //         $bcFactsValueAll += $value->bcFact->value_fact;
    //     }
        

    //     $bcQuestionCheckBoxs = [];
    //     $bcFactsValue = 0;
    //     foreach ($request->bcQuestion as $key => $value) {
    //         $bcQuestionCheckBox = BcQuestion::find($value)->load('bcFact');
    //         $bcFactsValue += $bcQuestionCheckBox->bcFact->value_fact;
    //         $bcQuestionCheckBoxs[] = $bcQuestionCheckBox;
    //     }

    //     // 40 = 100
    //     // 10,5 = 

    //     return [
    //         'semuaQuestion' => $bcQuestions,
    //         'bcQuestionCheckBoxs' => $bcQuestionCheckBoxs,
    //         'bcFactsValue' => $bcFactsValue,
    //         'hasil' => (100 * $bcFactsValue) / $bcFactsValueAll ,
    //     ];


    //     return $bcQuestionCheckBoxs;
    // }

    public function results(Request $request) {
        // diagnosa penyakit / result
        $bcResult = BcQuestion::find($request->bcQuestion[0])->bcResult;
        // Semua pertanyaan
        $bcQuestions = $bcResult->bcQuestions->load('bcFact');
        //all question count
        $bcQuestionsCount = count($bcQuestions);
        
        // Pertanyaan yang dipilih
        $bcQuestionCheckBoxs = [];
        foreach ($request->bcQuestion as $key => $value) {
            $bcQuestionCheckBox = BcQuestion::find($value)->load('bcFact');
            $bcQuestionCheckBoxs[] = $bcQuestionCheckBox;
        }
        
        // Hitung total nilai faktor dari pertanyaan yang dicentang
        $totalFaktorDicentang = 0;
        foreach ($bcQuestionCheckBoxs as $question) {
            $totalFaktorDicentang += $question->bcFact->value_fact;
        }
        
        // Tentukan nilai faktor maksimal (disesuaikan dengan kebutuhan Anda)
        // $nilaiFaktorMaksimal = 100; // Misalnya, 100 adalah nilai faktor maksimal
        $nilaiFaktorMaksimal = $bcQuestionsCount * 10; // Misalnya, 100 adalah nilai faktor maksimal
        
        // Hitung persentase kemungkinan
        $persentaseKemungkinan = ($totalFaktorDicentang / $nilaiFaktorMaksimal) * 100;
        
        // Tampilkan hasil kepada pengguna
        $diagnosis = "Sapi kena penyakit " . $bcResult->name ." kemungkinan " . number_format($persentaseKemungkinan, 2) . "%";
    
        return view('bc.try.results',compact('diagnosis','bcResult'));
    }
    
}
