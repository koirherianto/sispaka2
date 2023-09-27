<?php

namespace App\Http\Controllers\BC;

use App\Http\Requests\CreateBcResultRequest;
use App\Http\Requests\UpdateBcResultRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BcResultRepository;
use Illuminate\Http\Request;
use App\Models\Project;
use Flash;
use Auth;
use DB;

class BcResultController extends AppBaseController
{
    /** @var BcResultRepository $bcResultRepository*/
    private $bcResultRepository;

    public function __construct(BcResultRepository $bcResultRepo)
    {
        $this->bcResultRepository = $bcResultRepo;
    }

    /**
     * Display a listing of the BcResult.
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('super-admin')) {
            $bcResults = $this->bcResultRepository->paginate(10);
            foreach ($bcResults->items() as $bcResult) {
                $usersMaker = $bcResult->backwardChaining->project->users;
                $usersMaker = $usersMaker->implode('name', ', ');
                $bcResult->usersMaker = $usersMaker;
            }
        }
            
        if (Auth::user()->hasRole(['individu','institution'])) {
            $sessionProject = Auth::user()->session_project;
            $bcResults = Project::find($sessionProject)->backwardChainings->bcResults()->paginate(10);
        }    
            
        return view('bc.results.index')->with('bcResults', $bcResults);
    }

    /**
     * Show the form for creating a new BcResult.
     */
    public function create()
    {
        $isEditPage = false;
        $projects = Project::all();
        return view('bc.results.create', compact('projects','isEditPage'));
    }

    /**
     * Store a newly created BcResult in storage.
     */
    public function store(CreateBcResultRequest $request)
    {
        $input = $request->all();

        if (Auth::user()->hasRole('super-admin')) {
            $input['backward_chaining_id'] = Project::find($input['project_id'])->backwardChainings->id;
        }

        if (Auth::user()->hasRole(['individu','institution'])) {
            $sessionProject = Auth::user()->session_project;
            $input['backward_chaining_id'] = Project::find($sessionProject)->backwardChainings->id;
        }

        $bcResult = $this->bcResultRepository->create($input);

        if ($request->hasFile('image_result')) {
            $file = $request->file('image_result');
            $bcResult->addMedia($file)->toMediaCollection('bc_result');
        }

        Flash::success('Bc Result saved successfully.');
        return redirect(route('bcResults.index'));
    }

    /**
     * Display the specified BcResult.
     */
    public function show($id)
    {
        $bcResult = $this->bcResultRepository->find($id);

        if (empty($bcResult)) {
            Flash::error('Bc Result not found');
            return redirect(route('bcResults.index'));
        }

        $usersMaker = $bcResult->backwardChaining->project->users;
        $usersMaker = $usersMaker->implode('name', ', ');
        $bcResult->usersMaker = $usersMaker;

        return view('bc.results.show')->with('bcResult', $bcResult);
    }

    /**
     * Show the form for editing the specified BcResult.
     */
    public function edit($id)
    {
        $bcResult = $this->bcResultRepository->find($id);

        if (empty($bcResult)) {
            Flash::error('Bc Result not found');
            return redirect(route('bcResults.index'));
        }

        $isEditPage = true;
        $projects = Project::all();

        return view('bc.results.edit', compact('bcResult','projects','isEditPage'));
    }

    /**
     * Update the specified BcResult in storage.
     */
    public function update($id, UpdateBcResultRequest $request)
    {
        $bcResult = $this->bcResultRepository->find($id);

        if (empty($bcResult)) {
            Flash::error('Bc Result not found');
            return redirect(route('bcResults.index'));
        }

        $input = $request->all();
        unset($input['backward_chaining_id']);

        if ($request->hasFile('image_result')) {
            $file = $request->file('image_result');
            $bcResult->clearMediaCollection('bc_result');
            $bcResult->addMedia($file)->toMediaCollection('bc_result');
        }

        $bcResult = $this->bcResultRepository->update($input, $id);

        Flash::success('Bc Result updated successfully.');
        return redirect(route('bcResults.index'));
    }

    /**
     * Remove the specified BcResult from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bcResult = $this->bcResultRepository->find($id);

        if (empty($bcResult)) {
            Flash::error('Bc Result not found');
            return redirect(route('bcResults.index'));
        }

        DB::transaction(function () use($bcResult,$id) {
            $bcResult->bcQuestions()->delete();
            // Hapus gambar terkait
            $bcResult->getMedia('bc_result')->each(function ($media) {
                $media->delete();
            });
            $this->bcResultRepository->delete($id);
        },3);

        Flash::success('Bc Result deleted successfully.');
        return redirect(route('bcResults.index'));
    }
}
