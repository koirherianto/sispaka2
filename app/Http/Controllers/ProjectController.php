<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectRepository;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Models\Method;
use App\Models\Project;
use App\Models\BC\BcFact;
use App\Models\BC\BackwardChaining;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media as Mediax;
use DB;
use Auth;
use Flash;

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
        }
        
        if (Auth::user()->hasRole(['individu','institution'])) {
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
        $isEditPage = false;
        $methods = Method::all();

        if (Auth::user()->hasRole('super-admin')) {
            $users = User::whereHas('roles', function($q){
                $q->whereIn('name', ['individu', 'institution']);
            })->get();
        }

        return view('projects.create', compact('users', 'methods', 'isEditPage'));
    }


    /**
     * Store a newly created Project in storage.
     */
    public function store(CreateProjectRequest $request)
    {
        $input = $request->all();
        $input['status_publish'] = 'not_publish';

        if (Auth::user()->hasRole(['individu','institution'])) {
            $input['user_id'] = auth()->user()->id;
        }

        // jika checkbox belum dipilih
        if (!(isset($input['method_ids']) && is_array($input['method_ids']))) {
            Flash::error('Choose at least one method');
            return redirect(route('projects.create'));
        }

        // jika slug ada yang sama dengan slug yang sudah ada
        $input['slug'] = Project::createUniqueSlug($input['title']);
        if ($input['slug'] != $currentSlug) {
            // Slug berbeda, maka perbarui slug proyek
            $project->slug = $input['slug'];
            $project->save();
        }
        
        DB::transaction(function () use ($input, $request) {
            $project = $this->projectRepository->create($input);
            $project->users()->sync($input['user_id']);
        
            // Mengelola metode yang dipilih (dari checkbox)
            $project->methods()->sync($input['method_ids']);
            BackwardChaining::create([
                'project_id' => $project->id
            ]);
        }, 3);
        

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
         // Cek apakah title berubah
        if ($input['title'] !== $project->title) {
            $input['slug'] = Project::createUniqueSlug($input['title']);
        }else{
            $input['slug'] = $project->slug ?? Project::createUniqueSlug($input['title']);
        }

        if ($input['status_publish'] === 'publish') {
            if (empty($input['title']) && empty($input['short_description']) && empty($input['tag_keyword']) && empty($input['description']) && empty($input['image_description'])) {
                Flash::error('Fill all Field');
                return redirect(route('projects.edit', $id));
            }

            $jumlahKata = str_word_count($input['description']);

            if ($jumlahKata < 500) {
                Flash::error('Blog must be at least 500 words');
                return redirect(route('projects.edit', $id));
            }
        }
        
        if (Auth::user()->hasRole(['individu','institution'])) {
            $input['user_id'] = auth()->user()->id;
        }

        // Validasi gambar harus berbentuk landscape
        if ($request->hasFile('image_project')) {
            $file = $request->file('image_project');
            list($width, $height) = getimagesize($file);
            if ($width < $height) {
                Flash::error('Image must be in landscape format (width > height)');
                return redirect(route('projects.edit', $id));
            }
        }

        DB::transaction(function () use ($input, $id, $request) {
            $project = $this->projectRepository->update($input, $id);
            $project->users()->sync($input['user_id']);
        
            // Mencari media dengan deskripsi yang cocok
            $media = $project->getFirstMedia('image_project', function ($file) use ($input) {
                return $file->getCustomProperty('description') === $input['image_description'];
            });
        
            if ($request->hasFile('image_project')) {
                // Jika ada file yang diunggah, Anda dapat memprosesnya di sini
                $project->clearMediaCollection('image_project');
                $file = $request->file('image_project');
                $file = $this->optimizeAndConvertToWebP($file);
                $media = $project->addMediaFromRequest('image_project')
                    ->withCustomProperties(['description' => $input['image_description']])
                    ->toMediaCollection('image_project');
            } elseif ($media) {
                // Jika tidak ada file yang diunggah, tetapi ada media dengan deskripsi yang cocok
                // Anda hanya perlu mengubah deskripsinya
                $media->setCustomProperty('description', $input['image_description']);
                $media->save();
            }
        }, 3);

        if (!$project->getFirstMedia('image_project')) {
            Flash::error('Image Project is required');
            return redirect(route('projects.edit', $id));
        }
        
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

        DB::transaction(function () use ($id, $project) {
            $project->users()->sync([]);
            $project->methods()->sync([]);

            $bcFacts = $project->backwardChainings->bcFacts;
            $bcResults = $project->backwardChainings->bcResults;
        
            // Hapus semua bcQuestions yang terkait dengan bcFacts
            $bcFacts->each(function ($bcFact) {
                $bcFact->bcQuestions->each(function ($bcQuestion) {
                    $bcQuestion->delete();
                });
            });
        
            // Hapus semua bcQuestions yang terkait dengan bcResults
            $bcResults->each(function ($bcResult) {
                $bcResult->bcQuestions->each(function ($bcQuestion) {
                    $bcQuestion->delete();
                });
            });
        
            // Hapus semua bcFacts
            $bcFacts->each->delete();
        
            // Hapus semua bcResults
            $bcResults->each->delete();
        
            // Hapus backwardChaining
            $project->backwardChainings->delete();

            // hapus session_project pada user yang memiliki id project ini
            User::all()->each(function ($user) use ($id) {
                if ($user->session_project == $id) {
                    $user->session_project = null;
                    $user->save();
                }
            });
        
            // Auth::user()->session_project = null;
            $this->projectRepository->delete($id);
        }, 3);
        
        
        Flash::success('Project  deleted successfully.');
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


    private function optimizeAndConvertToWebP($file, $quality = 50)
    {
        $imageSize = $file->getSize();
        $image = Image::load($file)->optimize()->format(Manipulations::FORMAT_WEBP);

        // $image->fit(Manipulations::FIT_FILL, 1500, 500);
        
        if ($imageSize > 1024 * 1024) { // Lebih besar dari 1MB
            $image->quality($quality);
        }

        return $image->save();
    }

    public function validateImageLandscape(Mediax $media) : bool
    {
        $width = $media->width();
        $height = $media->height();

        if ($width < $height) {
            return false;
        }

        return true;
    }

}
