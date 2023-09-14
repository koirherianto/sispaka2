<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMethodAPIRequest;
use App\Http\Requests\API\UpdateMethodAPIRequest;
use App\Models\Method;
use App\Repositories\MethodRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class MethodAPIController
 */
class MethodAPIController extends AppBaseController
{
    private MethodRepository $methodRepository;

    public function __construct(MethodRepository $methodRepo)
    {
        $this->methodRepository = $methodRepo;
    }

    /**
     * Display a listing of the Methods.
     * GET|HEAD /methods
     */
    public function index(Request $request): JsonResponse
    {
        $methods = $this->methodRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($methods->toArray(), 'Methods retrieved successfully');
    }

    /**
     * Store a newly created Method in storage.
     * POST /methods
     */
    public function store(CreateMethodAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $method = $this->methodRepository->create($input);

        return $this->sendResponse($method->toArray(), 'Method saved successfully');
    }

    /**
     * Display the specified Method.
     * GET|HEAD /methods/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Method $method */
        $method = $this->methodRepository->find($id);

        if (empty($method)) {
            return $this->sendError('Method not found');
        }

        return $this->sendResponse($method->toArray(), 'Method retrieved successfully');
    }

    /**
     * Update the specified Method in storage.
     * PUT/PATCH /methods/{id}
     */
    public function update($id, UpdateMethodAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Method $method */
        $method = $this->methodRepository->find($id);

        if (empty($method)) {
            return $this->sendError('Method not found');
        }

        $method = $this->methodRepository->update($input, $id);

        return $this->sendResponse($method->toArray(), 'Method updated successfully');
    }

    /**
     * Remove the specified Method from storage.
     * DELETE /methods/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Method $method */
        $method = $this->methodRepository->find($id);

        if (empty($method)) {
            return $this->sendError('Method not found');
        }

        $method->delete();

        return $this->sendSuccess('Method deleted successfully');
    }
}
