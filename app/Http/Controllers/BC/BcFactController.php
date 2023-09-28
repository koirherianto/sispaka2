<?php

namespace App\Http\Controllers\BC;

use App\Http\Requests\CreateBcFactRequest;
use App\Http\Requests\UpdateBcFactRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BcFactRepository;
use Illuminate\Http\Request;
use App\Models\Project;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Flash;
use Auth;
use DB;

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
            $bcFacts = $this->bcFactRepository->orderBy('created_at', 'desc')->paginate(10);
            foreach ($bcFacts->items() as $bcFact) {
                $usersMaker = $bcFact->backwardChaining->project->users;
                $usersMaker = $usersMaker->implode('name', ', ');
                $bcFact->usersMaker = $usersMaker;
            }
        }

        if (Auth::user()->hasRole(['individu','institution'])) {
            $sessionProject = Auth::user()->session_project;
            $bcFacts = Project::find($sessionProject)
            ->backwardChainings
            ->bcFacts()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
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

        if ($request->hasFile('image_fact')) {
            $file = $request->file('image_fact');
            
            // Periksa ukuran file gambar
            $imageSize = $file->getSize(); // Ukuran dalam bytes
            
            if ($imageSize > 1024 * 1024) { // Lebih dari 1MB (1MB = 1024 * 1024 bytes)
                // Jika ukuran lebih dari 1MB, optimalkan dengan kualitas 50%
                Image::load($file)
                    ->optimize()
                    ->format(Manipulations::FORMAT_WEBP)
                    ->quality(50) // Kualitas 50%
                    ->save();
            } else {
                // Jika ukuran kurang dari atau sama dengan 1MB, hanya lakukan konversi ke WebP
                Image::load($file)
                    ->optimize()
                    ->format(Manipulations::FORMAT_WEBP)
                    ->save();
            }
        }
        

        DB::transaction(function () use($request,$input) {
            $bcFact = $this->bcFactRepository->create($input);
            if ($request->hasFile('image_fact')) {
                $file = $request->file('image_fact');
                $bcFact->addMedia($file)
                ->withCustomProperties(['description' => $input['image_description']])
                ->toMediaCollection('bc_fact');
            }    
        },3);

        
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

        // return $bcFact->getMedia('bc_fact');

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

        if ($request->hasFile('image_fact')) {
            $file = $request->file('image_fact');
            
            $imageSize = $file->getSize(); 
            
            if ($imageSize > 1024 * 1024) { 
                Image::load($file)
                    ->optimize()
                    ->format(Manipulations::FORMAT_WEBP)
                    ->quality(50) // Kualitas 50%
                    ->save();
            } else {
                // Jika ukuran kurang dari atau sama dengan 1MB, hanya lakukan konversi ke WebP
                Image::load($file)
                    ->optimize()
                    ->format(Manipulations::FORMAT_WEBP)
                    ->save();
            }
        }

        DB::transaction(function () use ($bcFact, $request, $input, $id) {
            $bcFact = $this->bcFactRepository->update($input, $id);
            if ($request->hasFile('image_fact')) {
                $file = $request->file('image_fact');
                $bcFact->clearMediaCollection('bc_fact');
                $bcFact->addMedia($file)
                    ->withCustomProperties(['description' => $input['image_description']])
                    ->toMediaCollection('bc_fact');
            } elseif ($input['image_description']) {
                // Jika tidak ada perubahan gambar, tetapi ada perubahan deskripsi, update deskripsi.
                $media = $bcFact->getMedia('bc_fact')->first();
                if ($media) {
                    $media->setCustomProperty('description', $input['image_description']);
                    $media->save();
                }
            }
        }, 3);

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

        DB::transaction(function () use($bcFact,$id) {
            $bcFact->bcQuestions()->delete();
            $bcFact->getMedia('bc_fact')->each(function ($media) {
                $media->delete();
            });
            $this->bcFactRepository->delete($id);
        },3);

        Flash::success('Bc Fact deleted successfully.');
        return redirect(route('bcFacts.index'));
    }
}
