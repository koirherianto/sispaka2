<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermisionRequest;
use App\Http\Requests\UpdatePermisionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PermisionRepository;
use Illuminate\Http\Request;
use Flash;

class PermisionController extends AppBaseController
{
    /** @var PermisionRepository $permisionRepository*/
    private $permisionRepository;

    public function __construct(PermisionRepository $permisionRepo)
    {
        $this->permisionRepository = $permisionRepo;
    }

    /**
     * Display a listing of the Permision.
     */
    public function index(Request $request)
    {
        $permisions = $this->permisionRepository->paginate(10);

        return view('permisions.index')
            ->with('permisions', $permisions);
    }

    /**
     * Show the form for creating a new Permision.
     */
    public function create()
    {
        return view('permisions.create');
    }

    /**
     * Store a newly created Permision in storage.
     */
    public function store(CreatePermisionRequest $request)
    {
        $input = $request->all();

        $permision = $this->permisionRepository->create($input);

        Flash::success('Permision saved successfully.');

        return redirect(route('permisions.index'));
    }

    /**
     * Display the specified Permision.
     */
    public function show($id)
    {
        $permision = $this->permisionRepository->find($id);

        if (empty($permision)) {
            Flash::error('Permision not found');

            return redirect(route('permisions.index'));
        }

        return view('permisions.show')->with('permision', $permision);
    }

    /**
     * Show the form for editing the specified Permision.
     */
    public function edit($id)
    {
        $permision = $this->permisionRepository->find($id);

        if (empty($permision)) {
            Flash::error('Permision not found');

            return redirect(route('permisions.index'));
        }

        return view('permisions.edit')->with('permision', $permision);
    }

    /**
     * Update the specified Permision in storage.
     */
    public function update($id, UpdatePermisionRequest $request)
    {
        $permision = $this->permisionRepository->find($id);

        if (empty($permision)) {
            Flash::error('Permision not found');

            return redirect(route('permisions.index'));
        }

        $permision = $this->permisionRepository->update($request->all(), $id);

        Flash::success('Permision updated successfully.');

        return redirect(route('permisions.index'));
    }

    /**
     * Remove the specified Permision from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $permision = $this->permisionRepository->find($id);

        if (empty($permision)) {
            Flash::error('Permision not found');

            return redirect(route('permisions.index'));
        }

        $this->permisionRepository->delete($id);

        Flash::success('Permision deleted successfully.');

        return redirect(route('permisions.index'));
    }
}
