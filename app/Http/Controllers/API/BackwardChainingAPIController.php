<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBackwardChainingAPIRequest;
use App\Http\Requests\API\UpdateBackwardChainingAPIRequest;
use App\Models\BackwardChaining;
use App\Repositories\BackwardChainingRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class BackwardChainingAPIController
 */
class BackwardChainingAPIController extends AppBaseController
{
    private BackwardChainingRepository $backwardChainingRepository;

    public function __construct(BackwardChainingRepository $backwardChainingRepo)
    {
        $this->backwardChainingRepository = $backwardChainingRepo;
    }

    /**
     * Display a listing of the BackwardChainings.
     * GET|HEAD /backward-chainings
     */
    public function index(Request $request): JsonResponse
    {
        $backwardChainings = $this->backwardChainingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($backwardChainings->toArray(), 'Backward Chainings retrieved successfully');
    }

    /**
     * Store a newly created BackwardChaining in storage.
     * POST /backward-chainings
     */
    public function store(CreateBackwardChainingAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $backwardChaining = $this->backwardChainingRepository->create($input);

        return $this->sendResponse($backwardChaining->toArray(), 'Backward Chaining saved successfully');
    }

    /**
     * Display the specified BackwardChaining.
     * GET|HEAD /backward-chainings/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var BackwardChaining $backwardChaining */
        $backwardChaining = $this->backwardChainingRepository->find($id);

        if (empty($backwardChaining)) {
            return $this->sendError('Backward Chaining not found');
        }

        return $this->sendResponse($backwardChaining->toArray(), 'Backward Chaining retrieved successfully');
    }

    /**
     * Update the specified BackwardChaining in storage.
     * PUT/PATCH /backward-chainings/{id}
     */
    public function update($id, UpdateBackwardChainingAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var BackwardChaining $backwardChaining */
        $backwardChaining = $this->backwardChainingRepository->find($id);

        if (empty($backwardChaining)) {
            return $this->sendError('Backward Chaining not found');
        }

        $backwardChaining = $this->backwardChainingRepository->update($input, $id);

        return $this->sendResponse($backwardChaining->toArray(), 'BackwardChaining updated successfully');
    }

    /**
     * Remove the specified BackwardChaining from storage.
     * DELETE /backward-chainings/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var BackwardChaining $backwardChaining */
        $backwardChaining = $this->backwardChainingRepository->find($id);

        if (empty($backwardChaining)) {
            return $this->sendError('Backward Chaining not found');
        }

        $backwardChaining->delete();

        return $this->sendSuccess('Backward Chaining deleted successfully');
    }
}
