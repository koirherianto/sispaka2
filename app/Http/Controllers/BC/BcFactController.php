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
        if (Auth::user()->hasRole('super-admin')) {
            $bcFacts = $this->bcFactRepository->paginate(10);
            foreach ($bcFacts->items() as $bcFact) {
                $usersMaker = $bcFact->backwardChaining->project->users;
                $usersMaker = $usersMaker->implode('name', ', ');
                $bcFact->usersMaker = $usersMaker;
            }
        }

        if (Auth::user()->hasRole(['individu','institution'])) {
            $sessionProject = Auth::user()->session_project;
            $bcFacts = Project::find($sessionProject)->backwardChainings->bcFacts()->paginate(10);
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
        
        if (Auth::user()->hasRole('super-admin')) {
            $input['backward_chaining_id'] = Project::find($input['project_id'])->backwardChainings->id;
        }

        if (Auth::user()->hasRole(['individu','institution'])) {
            $sessionProject = Auth::user()->session_project;
            $input['backward_chaining_id'] = Project::find($sessionProject)->backwardChainings->id;
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

        $usersMaker = $bcFact->backwardChaining->project->users;
        $usersMaker = $usersMaker->implode('name', ', ');
        $bcFact->usersMaker = $usersMaker;

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
        unset($input['backward_chaining_id']);

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

        // $bcFact->bc_questions->delete();
        $this->bcFactRepository->delete($id);

        Flash::success('Bc Fact deleted successfully.');
        return redirect(route('bcFacts.index'));
    }
}
