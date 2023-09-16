<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBcQuestionAPIRequest;
use App\Http\Requests\API\UpdateBcQuestionAPIRequest;
use App\Models\BcQuestion;
use App\Repositories\BcQuestionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class BcQuestionAPIController
 */
class BcQuestionAPIController extends AppBaseController
{
    private BcQuestionRepository $bcQuestionRepository;

    public function __construct(BcQuestionRepository $bcQuestionRepo)
    {
        $this->bcQuestionRepository = $bcQuestionRepo;
    }

    /**
     * Display a listing of the BcQuestions.
     * GET|HEAD /bc-questions
     */
    public function index(Request $request): JsonResponse
    {
        $bcQuestions = $this->bcQuestionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($bcQuestions->toArray(), 'Bc Questions retrieved successfully');
    }

    /**
     * Store a newly created BcQuestion in storage.
     * POST /bc-questions
     */
    public function store(CreateBcQuestionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $bcQuestion = $this->bcQuestionRepository->create($input);

        return $this->sendResponse($bcQuestion->toArray(), 'Bc Question saved successfully');
    }

    /**
     * Display the specified BcQuestion.
     * GET|HEAD /bc-questions/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var BcQuestion $bcQuestion */
        $bcQuestion = $this->bcQuestionRepository->find($id);

        if (empty($bcQuestion)) {
            return $this->sendError('Bc Question not found');
        }

        return $this->sendResponse($bcQuestion->toArray(), 'Bc Question retrieved successfully');
    }

    /**
     * Update the specified BcQuestion in storage.
     * PUT/PATCH /bc-questions/{id}
     */
    public function update($id, UpdateBcQuestionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var BcQuestion $bcQuestion */
        $bcQuestion = $this->bcQuestionRepository->find($id);

        if (empty($bcQuestion)) {
            return $this->sendError('Bc Question not found');
        }

        $bcQuestion = $this->bcQuestionRepository->update($input, $id);

        return $this->sendResponse($bcQuestion->toArray(), 'BcQuestion updated successfully');
    }

    /**
     * Remove the specified BcQuestion from storage.
     * DELETE /bc-questions/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var BcQuestion $bcQuestion */
        $bcQuestion = $this->bcQuestionRepository->find($id);

        if (empty($bcQuestion)) {
            return $this->sendError('Bc Question not found');
        }

        $bcQuestion->delete();

        return $this->sendSuccess('Bc Question deleted successfully');
    }
}
