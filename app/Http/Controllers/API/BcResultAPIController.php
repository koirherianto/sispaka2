<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBcResultAPIRequest;
use App\Http\Requests\API\UpdateBcResultAPIRequest;
use App\Models\BC\BcResult;
use App\Repositories\BcResultRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class BcResultAPIController
 */
class BcResultAPIController extends AppBaseController
{
    private BcResultRepository $bcResultRepository;

    public function __construct(BcResultRepository $bcResultRepo)
    {
        $this->bcResultRepository = $bcResultRepo;
    }

    /**
     * Display a listing of the BcResults.
     * GET|HEAD /bc-results
     */
    public function index(Request $request): JsonResponse
    {
        $bcResults = $this->bcResultRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($bcResults->toArray(), 'Bc Results retrieved successfully');
    }

    /**
     * Store a newly created BcResult in storage.
     * POST /bc-results
     */
    public function store(CreateBcResultAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $bcResult = $this->bcResultRepository->create($input);

        return $this->sendResponse($bcResult->toArray(), 'Bc Result saved successfully');
    }

    /**
     * Display the specified BcResult.
     * GET|HEAD /bc-results/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var BcResult $bcResult */
        $bcResult = $this->bcResultRepository->find($id);

        if (empty($bcResult)) {
            return $this->sendError('Bc Result not found');
        }

        return $this->sendResponse($bcResult->toArray(), 'Bc Result retrieved successfully');
    }

    /**
     * Update the specified BcResult in storage.
     * PUT/PATCH /bc-results/{id}
     */
    public function update($id, UpdateBcResultAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var BcResult $bcResult */
        $bcResult = $this->bcResultRepository->find($id);

        if (empty($bcResult)) {
            return $this->sendError('Bc Result not found');
        }

        $bcResult = $this->bcResultRepository->update($input, $id);

        return $this->sendResponse($bcResult->toArray(), 'BcResult updated successfully');
    }

    /**
     * Remove the specified BcResult from storage.
     * DELETE /bc-results/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var BcResult $bcResult */
        $bcResult = $this->bcResultRepository->find($id);

        if (empty($bcResult)) {
            return $this->sendError('Bc Result not found');
        }

        $bcResult->delete();

        return $this->sendSuccess('Bc Result deleted successfully');
    }
}
