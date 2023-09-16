<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBcResultRequest;
use App\Http\Requests\UpdateBcResultRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BcResultRepository;
use Illuminate\Http\Request;
use Flash;

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
        $bcResults = $this->bcResultRepository->paginate(10);

        return view('bc_results.index')
            ->with('bcResults', $bcResults);
    }

    /**
     * Show the form for creating a new BcResult.
     */
    public function create()
    {
        return view('bc_results.create');
    }

    /**
     * Store a newly created BcResult in storage.
     */
    public function store(CreateBcResultRequest $request)
    {
        $input = $request->all();

        $bcResult = $this->bcResultRepository->create($input);

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

        return view('bc_results.show')->with('bcResult', $bcResult);
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

        return view('bc_results.edit')->with('bcResult', $bcResult);
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

        $bcResult = $this->bcResultRepository->update($request->all(), $id);

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

        $this->bcResultRepository->delete($id);

        Flash::success('Bc Result deleted successfully.');

        return redirect(route('bcResults.index'));
    }
}
