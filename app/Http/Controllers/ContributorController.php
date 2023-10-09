<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContributorRequest;
use App\Http\Requests\UpdateContributorRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ContributorRepository;
use Illuminate\Http\Request;
use Flash;

class ContributorController extends AppBaseController
{
    /** @var ContributorRepository $contributorRepository*/
    private $contributorRepository;

    public function __construct(ContributorRepository $contributorRepo)
    {
        $this->contributorRepository = $contributorRepo;
    }

    /**
     * Display a listing of the Contributor.
     */
    public function index(Request $request)
    {
        $contributors = $this->contributorRepository->paginate(10);

        return view('contributors.index')
            ->with('contributors', $contributors);
    }

    /**
     * Show the form for creating a new Contributor.
     */
    public function create()
    {
        return view('contributors.create');
    }

    /**
     * Store a newly created Contributor in storage.
     */
    public function store(CreateContributorRequest $request)
    {
        $input = $request->all();

        $contributor = $this->contributorRepository->create($input);

        Flash::success('Contributor saved successfully.');

        return redirect(route('contributors.index'));
    }

    /**
     * Display the specified Contributor.
     */
    public function show($id)
    {
        $contributor = $this->contributorRepository->find($id);

        if (empty($contributor)) {
            Flash::error('Contributor not found');

            return redirect(route('contributors.index'));
        }

        return view('contributors.show')->with('contributor', $contributor);
    }

    /**
     * Show the form for editing the specified Contributor.
     */
    public function edit($id)
    {
        $contributor = $this->contributorRepository->find($id);

        if (empty($contributor)) {
            Flash::error('Contributor not found');

            return redirect(route('contributors.index'));
        }

        return view('contributors.edit')->with('contributor', $contributor);
    }

    /**
     * Update the specified Contributor in storage.
     */
    public function update($id, UpdateContributorRequest $request)
    {
        $contributor = $this->contributorRepository->find($id);

        if (empty($contributor)) {
            Flash::error('Contributor not found');

            return redirect(route('contributors.index'));
        }

        $contributor = $this->contributorRepository->update($request->all(), $id);

        Flash::success('Contributor updated successfully.');

        return redirect(route('contributors.index'));
    }

    /**
     * Remove the specified Contributor from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $contributor = $this->contributorRepository->find($id);

        if (empty($contributor)) {
            Flash::error('Contributor not found');

            return redirect(route('contributors.index'));
        }

        $this->contributorRepository->delete($id);

        Flash::success('Contributor deleted successfully.');

        return redirect(route('contributors.index'));
    }
}
