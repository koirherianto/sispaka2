<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Method;
use DB;
use Flash;
use Auth;

class ProjectController extends AppBaseController
{
    /** @var ProjectRepository $projectRepository*/
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepository = $projectRepo;
    }

    /**
     * Display a listing of the Project.
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('super-admin')) {
            $projects = $this->projectRepository->paginate(10);
        }else{
            $projects = Auth::user()->projects()->paginate(10);
        }

        $projects->each(function ($project) {
            $project->status_publish = $this->statusPublishEnum($project->status_publish);
        });

        return view('projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new Project.
     */
    public function create()
    {
        $users = [];
        if (Auth::user()->hasRole('super-admin')) {
            //ambil user yang punya role individu atau institusi
            $users = User::whereHas('roles', function($q){
                $q->whereIn('name', ['individu', 'institution']);
            })->get();
        }

        $isEditPage = false;
        $methods = Method::all();

        return view('projects.create', compact('users','methods','isEditPage'));
    }

    /**
     * Store a newly created Project in storage.
     */
    public function store(CreateProjectRequest $request)
    {
        $input = $request->all();

        //jika dia bukan super admin, maka user_id diisi dengan id user yang sedang login
        if (!Auth::user()->hasRole('super-admin')) {
            $input['user_id'] = auth()->user()->id;
        }

        DB::transaction(function () use($input) {
            $project = $this->projectRepository->create($input);
            $project->users()->sync($input['user_id']);
            $project->methods()->sync($input['method_id']);
        },3);

        Flash::success('Project saved successfully.');
        return redirect(route('projects.index'));
    }

    /**
     * Display the specified Project.
     */
    public function show($id)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');
            return redirect(route('projects.index'));
        }

        return view('projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified Project.
     */
    public function edit($id)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');
            return redirect(route('projects.index'));
        }

        $users = [];
        if (Auth::user()->hasRole('super-admin')) {
            $users = User::whereHas('roles', function($q){
                $q->whereIn('name', ['individu', 'institution']);
            })->get();
        }

        $isEditPage = true;
        $methods = Method::all();

        return view('projects.edit', compact('users', 'project', 'methods', 'isEditPage'));
    }

    /**
     * Update the specified Project in storage.
     */
    public function update($id, UpdateProjectRequest $request)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');
            return redirect(route('projects.index'));
        }

        $input = $request->all();
        
        if (!Auth::user()->hasRole('super-admin')) {
            $input['user_id'] = auth()->user()->id;
        }

        DB::transaction(function () use($input,$id) {
            $project = $this->projectRepository->update($input, $id);
            $project->users()->sync($input['user_id']);
        },3);

        Flash::success('Project updated successfully.');

        return redirect(route('projects.index'));
    }

    /**
     * Remove the specified Project from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');
            return redirect(route('projects.index'));
        }

        DB::transaction(function () use($id,$project) {
            //unsingkron many to many
            $project->users()->sync([]);
            $project->methods()->sync([]);
            $project->facts()->question()->delete();
            $project->result()->question()->delete();
            $project->facts()->delete();
            $project->result()->delete();
            Auth::user()->session_project = null;
            $this->projectRepository->delete($id);
        },3);
        
        Flash::success('Project deleted successfully.');
        return redirect(route('projects.index'));
    }

    function changeProject($id) {
        $user = Auth::user();
        $user->session_project = $id;
        $user->save();
        return redirect(route('projects.index'));
    }

    private function statusPublishEnum($enum) : String {
        
        if ($enum === 'not_publish') {
            return 'Not Publish';
        }
        if ($enum === 'publish') {
            return 'Publish';
        }

        return '';
    }
}
