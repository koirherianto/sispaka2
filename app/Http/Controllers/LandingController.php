<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\BC\BcQuestion;
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

    public function blog($slug) {
        $project = Project::where('slug',$slug)->first();

        if (empty($project)) {
            Flash::error('Choose at least one question');
            return redirect(route('landing'));
        }

        $seoTitle = $project->title;
        $seoKeyword = $project->tag_keyword;
        $seoDescription = $project->short_description; 

        $bcResults = $project->backwardChainings->bcResults;

        return view('landing.blog',compact('project','seoDescription','seoTitle','seoKeyword','bcResults'));
    }

    public function backwardChaining(Request $request) {
        $bcQuestions = BcQuestion::where('bc_result_id',$request->bc_result_id)->get();

        $project = Project::where('slug',$request->slug)->first();

        $seoTitle = $project->title;
        $seoKeyword = $project->tag_keyword;
        $seoDescription = $project->short_description; 

        

        return view('landing.backward-chaining',compact('project','bcQuestions','seoDescription','seoTitle','seoKeyword'));
    }

    public function backwardChainingResults(Request $request) {
        $project = Project::where('slug',$request->slug)->first();

        $seoTitle = $project->title;
        $seoKeyword = $project->tag_keyword;
        $seoDescription = $project->short_description; 

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
    
        return view('landing.backward-chaining-result',compact('project','diagnosis','bcResult','seoDescription','seoTitle','seoKeyword'));
    }
}
