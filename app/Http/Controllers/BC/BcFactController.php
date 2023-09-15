<?php

namespace App\Http\Controllers\BC;

use App\Http\Requests\CreateBcFactRequest;
use App\Http\Requests\UpdateBcFactRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BcFactRepository;
use Illuminate\Http\Request;
use App\Models\Project;
use Flash;
use Auth;

class BcFactController extends AppBaseController
{
    /** @var BcFactRepository $bcFactRepository*/
    private $bcFactRepository;

    public function __construct(BcFactRepository $bcFactRepo)
    {
        $this->bcFactRepository = $bcFactRepo;
    }

    /**
     * Display a listing of the BcFact.
     */
    public function index(Request $request)
    {
        $bcFacts = $this->bcFactRepository->paginate(10);

        return view('bc.facts.index')->with('bcFacts', $bcFacts);


        if (!Auth::user()->hasRole('super-admin')) {
            $sessionProject = Auth::user()->session_project;
            $bcFacts = Project::find($sessionProject)->backwardChainings->facts()->paginate(10);
        }else{
            $bcFacts = $this->factRepository->paginate(10);
        }

        return view('bc.facts.index')->with('bcFacts', $bcFacts);
    }

    /**
     * Show the form for creating a new BcFact.
     */
    public function create()
    {
        $isEditPage = false;
        $projects = Project::all();
        return view('bc.facts.create', compact('projects','isEditPage'));
    }

    /**
     * Store a newly created BcFact in storage.
     */
    public function store(CreateBcFactRequest $request)
    {
        $input = $request->all();

        if (!Auth::user()->hasRole('super-admin')) {
            $input['project_id'] = Auth::user()->session_project;
        }

        $bcFact = $this->bcFactRepository->create($input);

        Flash::success('Bc Fact saved successfully.');
        return redirect(route('bcFacts.index'));
    }

    /**
     * Display the specified BcFact.
     */
    public function show($id)
    {
        $bcFact = $this->bcFactRepository->find($id);

        if (empty($bcFact)) {
            Flash::error('Bc Fact not found');
            return redirect(route('bcFacts.index'));
        }

        return view('bc.facts.show')->with('bcFact', $bcFact);
    }

    /**
     * Show the form for editing the specified BcFact.
     */
    public function edit($id)
    {
        $bcFact = $this->bcFactRepository->find($id);

        if (empty($bcFact)) {
            Flash::error('Bc Fact not found');
            return redirect(route('bcFacts.index'));
        }

        $isEditPage = true;
        $projects = Project::all();

        return view('bc.facts.edit', compact('bcFact','projects','isEditPage'));
    }

    /**
     * Update the specified BcFact in storage.
     */
    public function update($id, UpdateBcFactRequest $request)
    {
        $bcFact = $this->bcFactRepository->find($id);

        if (empty($bcFact)) {
            Flash::error('Bc Fact not found');
            return redirect(route('bcFacts.index'));
        }

        $input = $request->all();

        if (!Auth::user()->hasRole('super-admin')) {
            $input['project_id'] = Auth::user()->session_project;
        }

        $bcFact = $this->bcFactRepository->update($input, $id);

        Flash::success('Bc Fact updated successfully.');
        return redirect(route('bcFacts.index'));
    }

    /**
     * Remove the specified BcFact from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bcFact = $this->bcFactRepository->find($id);

        if (empty($bcFact)) {
            Flash::error('Bc Fact not found');
            return redirect(route('bcFacts.index'));
        }

        // $fact->questions->delete();
        $this->bcFactRepository->delete($id);

        Flash::success('Bc Fact deleted successfully.');
        return redirect(route('bcFacts.index'));
    }
}
