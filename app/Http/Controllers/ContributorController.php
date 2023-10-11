<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContributorRequest;
use App\Http\Requests\UpdateContributorRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ContributorRepository;
use Illuminate\Http\Request;
use App\Models\Contributor;
use App\Models\User;
use App\Models\Project;
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
        // slug adalah project slug
        if (empty($request->slug)) {
            return redirect(route('projects.index'));
        }

        $project = Project::where('slug',$request->slug)->first();

        if (empty($project)) {
            Flash::error('Project not found');
            return redirect(route('projects.index'));
        }

        $contributors = Contributor::where('project_id',$project->id)->paginate(10);

        return view('contributors.index',compact('contributors','project'));
    }

    /**
     * Show the form for creating a new Contributor.
     */
    public function create(Request $request)
    {
        // slug adalah project slug
        if (empty($request->slug)) {
            return redirect(route('projects.index'));
        }

        $project = Project::where('slug',$request->slug)->first();

        if (empty($project)) {
            Flash::error('Project not found');
            return redirect(route('projects.index'));
        }

        return view('contributors.create',compact('project'));
    }

    /**
     * Store a newly created Contributor in storage.
     */
    public function store(CreateContributorRequest $request)
    {
        $input = $request->all();

        unset($input['user_id']);

        $user = User::where('email',$request->email)->first();

        if (!empty($user)) {
            $input['user_id'] = $user->id;
        }

        $contributor = $this->contributorRepository->create($input);

        Flash::success('Contributor saved successfully.');
        return redirect(route('contributors.index', ['slug' => $contributor->project->slug]));
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

        $project = Project::where('id',$contributor->project_id)->first();
        
        return view('contributors.edit',compact('contributor','project'));
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

        $user = User::where('email',$request->email)->first();

        if (!empty($user)) {
            $request['user_id'] = $user->id;
        }else{
            unset($request['user_id']);
        }

        $contributor = $this->contributorRepository->update($request->all(), $id);

        Flash::success('Contributor updated successfully.');
        return redirect(route('contributors.index', ['slug' => $contributor->project->slug]));
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
