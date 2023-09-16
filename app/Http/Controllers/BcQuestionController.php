<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBcQuestionRequest;
use App\Http\Requests\UpdateBcQuestionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BcQuestionRepository;
use Illuminate\Http\Request;
use Flash;

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
        $bcQuestions = $this->bcQuestionRepository->paginate(10);

        return view('bc_questions.index')
            ->with('bcQuestions', $bcQuestions);
    }

    /**
     * Show the form for creating a new BcQuestion.
     */
    public function create()
    {
        return view('bc_questions.create');
    }

    /**
     * Store a newly created BcQuestion in storage.
     */
    public function store(CreateBcQuestionRequest $request)
    {
        $input = $request->all();

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

        return view('bc_questions.show')->with('bcQuestion', $bcQuestion);
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

        return view('bc_questions.edit')->with('bcQuestion', $bcQuestion);
    }

    /**
     * Update the specified BcQuestion in storage.
     */
    public function update($id, UpdateBcQuestionRequest $request)
    {
        $bcQuestion = $this->bcQuestionRepository->find($id);

        if (empty($bcQuestion)) {
            Flash::error('Bc Question not found');

            return redirect(route('bcQuestions.index'));
        }

        $bcQuestion = $this->bcQuestionRepository->update($request->all(), $id);

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
