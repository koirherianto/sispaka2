<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContributorAPIRequest;
use App\Http\Requests\API\UpdateContributorAPIRequest;
use App\Models\Contributor;
use App\Repositories\ContributorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ContributorAPIController
 */
class ContributorAPIController extends AppBaseController
{
    private ContributorRepository $contributorRepository;

    public function __construct(ContributorRepository $contributorRepo)
    {
        $this->contributorRepository = $contributorRepo;
    }

    /**
     * Display a listing of the Contributors.
     * GET|HEAD /contributors
     */
    public function index(Request $request): JsonResponse
    {
        $contributors = $this->contributorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($contributors->toArray(), 'Contributors retrieved successfully');
    }

    /**
     * Store a newly created Contributor in storage.
     * POST /contributors
     */
    public function store(CreateContributorAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $contributor = $this->contributorRepository->create($input);

        return $this->sendResponse($contributor->toArray(), 'Contributor saved successfully');
    }

    /**
     * Display the specified Contributor.
     * GET|HEAD /contributors/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Contributor $contributor */
        $contributor = $this->contributorRepository->find($id);

        if (empty($contributor)) {
            return $this->sendError('Contributor not found');
        }

        return $this->sendResponse($contributor->toArray(), 'Contributor retrieved successfully');
    }

    /**
     * Update the specified Contributor in storage.
     * PUT/PATCH /contributors/{id}
     */
    public function update($id, UpdateContributorAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Contributor $contributor */
        $contributor = $this->contributorRepository->find($id);

        if (empty($contributor)) {
            return $this->sendError('Contributor not found');
        }

        $contributor = $this->contributorRepository->update($input, $id);

        return $this->sendResponse($contributor->toArray(), 'Contributor updated successfully');
    }

    /**
     * Remove the specified Contributor from storage.
     * DELETE /contributors/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Contributor $contributor */
        $contributor = $this->contributorRepository->find($id);

        if (empty($contributor)) {
            return $this->sendError('Contributor not found');
        }

        $contributor->delete();

        return $this->sendSuccess('Contributor deleted successfully');
    }
}
