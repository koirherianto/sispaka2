<?php

namespace App\Http\Controllers\BC;

use App\Http\Requests\CreateBcQuestionRequest;
use App\Http\Requests\UpdateBcQuestionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BcQuestionRepository;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\BC\BcResult;
use App\Models\BC\BcFact;
use App\Models\BC\BcQuestion;
use Flash;
use Auth;

class BcQuestionController extends AppBaseController
{
    /** @var BcQuestionRepository $bcQuestionRepository*/
    private $bcQuestionRepository;

    public function __construct(BcQuestionRepository $bcQuestionRepo)
    {
        $this->bcQuestionRepository = $bcQuestionRepo;
    }

    /**
     * Display a listing of the BcQuestion.
     */
    public function index(Request $request)
    {
        $sessionProject = Auth::user()->session_project;
        $backwardChainings = Project::find($sessionProject)->backwardChainings;

        $bcResults = $backwardChainings->bcResults;

        foreach ($bcResults as $bcResult) {
            $bcResult['bcQuestions'] = BcQuestion::where('bc_result_id',$bcResult->id)->with('bcFact')->get();  
        }

        return view('bc.questions.index')->with('bcResults', $bcResults);
    }

    /**
     * Show the form for creating a new BcQuestion.
     */
    public function create()
    {
        $sessionProject = Auth::user()->session_project;
        $backwardChaining = Project::find($sessionProject)->backwardChainings;

        $isEditPage = false;
        $bcFacts = $backwardChaining->bcFacts;
        $bcResults = $backwardChaining->bcResults;

        return view('bc.questions.create', compact('bcFacts', 'bcResults','isEditPage'));
    }

    /**
     * Store a newly created BcQuestion in storage.
     */
    public function store(CreateBcQuestionRequest $request)
    {
        $input = $request->all();
        //cek apakah ada data yang sama yang bc_result_id dan bc_fact_id nya sama
        $bcQuestion = BcQuestion::where('bc_result_id',$input['bc_result_id'])->where('bc_fact_id',$input['bc_fact_id'])->first();

        if($bcQuestion){
            Flash::error('Question already exists. when result and fact are the same');
            return redirect(route('bcQuestions.index'));
        }

        
        
        $bcQuestion = $this->bcQuestionRepository->create($input);

        Flash::success('Bc Question saved successfully.');
        return redirect(route('bcQuestions.index'));
    }

    /**
     * Display the specified BcQuestion.
     */
    public function show($id)
    {
        $bcQuestion = $this->bcQuestionRepository->find($id);

        if (empty($bcQuestion)) {
            Flash::error('Bc Question not found');
            return redirect(route('bcQuestions.index'));
        }

        return view('bc.questions.show')->with('bcQuestion', $bcQuestion);
    }

    /**
     * Show the form for editing the specified BcQuestion.
     */
    public function edit($id)
    {
        $bcQuestion = $this->bcQuestionRepository->find($id);

        if (empty($bcQuestion)) {
            Flash::error('Bc Question not found');
            return redirect(route('bcQuestions.index'));
        }

        $sessionProject = Auth::user()->session_project;
        $backwardChaining = Project::find($sessionProject)->backwardChainings;

        $isEditPage = false;
        $bcFacts = $backwardChaining->bcFacts;
        $bcResults = $backwardChaining->bcResults;

        return view('bc.questions.edit', compact('bcFacts','bcResults', 'bcQuestion','isEditPage'));
    }

    /**
     * Update the specified BcQuestion in storage.
     */
    public function update($id, UpdateBcQuestionRequest $request)
    {
        $bcQuestionOld = $this->bcQuestionRepository->find($id);

        if (empty($bcQuestionOld)) {
            Flash::error('Bc Question not found');
            return redirect(route('bcQuestions.index'));
        }

        $input = $request->all();
        
        // jika bc_result_id dan bc_fact_id sama dengan data yang lama
        if ($bcQuestionOld->bc_result_id == $input['bc_result_id'] && $bcQuestionOld->bc_fact_id == $input['bc_fact_id']) {
            $bcQuestion = $this->bcQuestionRepository->update($input, $id);

            Flash::success('Bc Question updated successfully.');
            return redirect(route('bcQuestions.index'));
        }
        
        // jika bc_result_id dan bc_fact_id beda dengan data yang lama
        $dataSama = BcQuestion::where('bc_result_id',$input['bc_result_id'])->where('bc_fact_id',$input['bc_fact_id'])->first();
        if($dataSama){
            Flash::error('Question already exists. when result and fact are the same with other question');
            return redirect(route('bcQuestions.index'));
        }

        $bcQuestion = $this->bcQuestionRepository->update($input, $id);

        Flash::success('Bc Question updated successfully.');
        return redirect(route('bcQuestions.index'));
    }

    /**
     * Remove the specified BcQuestion from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bcQuestion = $this->bcQuestionRepository->find($id);

        if (empty($bcQuestion)) {
            Flash::error('Bc Question not found');
            return redirect(route('bcQuestions.index'));
        }

        $this->bcQuestionRepository->delete($id);

        Flash::success('Bc Question deleted successfully.');
        return redirect(route('bcQuestions.index'));
    }
}
