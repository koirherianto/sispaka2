<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBcFactAPIRequest;
use App\Http\Requests\API\UpdateBcFactAPIRequest;
use App\Models\BC\BcFact;
use App\Repositories\BcFactRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class BcFactAPIController
 */
class BcFactAPIController extends AppBaseController
{
    private BcFactRepository $bcFactRepository;

    public function __construct(BcFactRepository $bcFactRepo)
    {
        $this->bcFactRepository = $bcFactRepo;
    }

    /**
     * Display a listing of the BcFacts.
     * GET|HEAD /bc-facts
     */
    public function index(Request $request): JsonResponse
    {
        $bcFacts = $this->bcFactRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($bcFacts->toArray(), 'Bc Facts retrieved successfully');
    }

    /**
     * Store a newly created BcFact in storage.
     * POST /bc-facts
     */
    public function store(CreateBcFactAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $bcFact = $this->bcFactRepository->create($input);

        return $this->sendResponse($bcFact->toArray(), 'Bc Fact saved successfully');
    }

    /**
     * Display the specified BcFact.
     * GET|HEAD /bc-facts/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var BcFact $bcFact */
        $bcFact = $this->bcFactRepository->find($id);

        if (empty($bcFact)) {
            return $this->sendError('Bc Fact not found');
        }

        return $this->sendResponse($bcFact->toArray(), 'Bc Fact retrieved successfully');
    }

    /**
     * Update the specified BcFact in storage.
     * PUT/PATCH /bc-facts/{id}
     */
    public function update($id, UpdateBcFactAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var BcFact $bcFact */
        $bcFact = $this->bcFactRepository->find($id);

        if (empty($bcFact)) {
            return $this->sendError('Bc Fact not found');
        }

        $bcFact = $this->bcFactRepository->update($input, $id);

        return $this->sendResponse($bcFact->toArray(), 'BcFact updated successfully');
    }

    /**
     * Remove the specified BcFact from storage.
     * DELETE /bc-facts/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var BcFact $bcFact */
        $bcFact = $this->bcFactRepository->find($id);

        if (empty($bcFact)) {
            return $this->sendError('Bc Fact not found');
        }

        $bcFact->delete();

        return $this->sendSuccess('Bc Fact deleted successfully');
    }
}
