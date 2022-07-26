<?php

namespace App\Http\Controllers;

use App\DataTables\CierresDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCierresRequest;
use App\Http\Requests\UpdateCierresRequest;
use App\Repositories\CierresRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CierresController extends AppBaseController
{
    /** @var  CierresRepository */
    private $cierresRepository;

    public function __construct(CierresRepository $cierresRepo)
    {
        $this->cierresRepository = $cierresRepo;
    }

    /**
     * Display a listing of the Cierres.
     *
     * @param CierresDataTable $cierresDataTable
     * @return Response
     */
    public function index(CierresDataTable $cierresDataTable)
    {
        return $cierresDataTable->render('cierres.index');
    }

    /**
     * Show the form for creating a new Cierres.
     *
     * @return Response
     */
    public function create()
    {
        return view('cierres.create');
    }

    /**
     * Store a newly created Cierres in storage.
     *
     * @param CreateCierresRequest $request
     *
     * @return Response
     */
    public function store(CreateCierresRequest $request)
    {
        $input = $request->all();

        $cierres = $this->cierresRepository->create($input);

        Flash::success('Cierres saved successfully.');

        return redirect(route('cierres.index'));
    }

    /**
     * Display the specified Cierres.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cierres = $this->cierresRepository->findWithoutFail($id);

        if (empty($cierres)) {
            Flash::error('Cierres not found');

            return redirect(route('cierres.index'));
        }

        return view('cierres.show')->with('cierres', $cierres);
    }

    /**
     * Show the form for editing the specified Cierres.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cierres = $this->cierresRepository->findWithoutFail($id);

        if (empty($cierres)) {
            Flash::error('Cierres not found');

            return redirect(route('cierres.index'));
        }

        return view('cierres.edit')->with('cierres', $cierres);
    }

    /**
     * Update the specified Cierres in storage.
     *
     * @param  int              $id
     * @param UpdateCierresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCierresRequest $request)
    {
        $cierres = $this->cierresRepository->findWithoutFail($id);

        if (empty($cierres)) {
            Flash::error('Cierres not found');

            return redirect(route('cierres.index'));
        }

        $cierres = $this->cierresRepository->update($request->all(), $id);

        Flash::success('Cierres updated successfully.');

        return redirect(route('cierres.index'));
    }

    /**
     * Remove the specified Cierres from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cierres = $this->cierresRepository->findWithoutFail($id);

        if (empty($cierres)) {
            Flash::error('Cierres not found');

            return redirect(route('cierres.index'));
        }

        $this->cierresRepository->delete($id);

        Flash::success('Cierres deleted successfully.');

        return redirect(route('cierres.index'));
    }
}
