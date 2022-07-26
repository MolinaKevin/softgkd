<?php

namespace App\Http\Controllers;

use App\DataTables\CierreDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCierreRequest;
use App\Http\Requests\UpdateCierreRequest;
use App\Repositories\CierreRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CierreController extends AppBaseController
{
    /** @var  CierreRepository */
    private $cierreRepository;

    public function __construct(CierreRepository $cierreRepo)
    {
        $this->cierreRepository = $cierreRepo;
    }

    /**
     * Display a listing of the Cierre.
     *
     * @param CierreDataTable $cierreDataTable
     * @return Response
     */
    public function index(CierreDataTable $cierreDataTable)
    {
        return $cierreDataTable->render('cierre.index');
    }

    /**
     * Show the form for creating a new Cierre.
     *
     * @return Response
     */
    public function create()
    {
        return view('cierre.create');
    }

    /**
     * Store a newly created Cierre in storage.
     *
     * @param CreateCierreRequest $request
     *
     * @return Response
     */
    public function store(CreateCierreRequest $request)
    {
        $input = $request->all();

        $cierre = $this->cierreRepository->create($input);

        Flash::success('Cierre saved successfully.');

        return redirect(route('cierre.index'));
    }

    /**
     * Display the specified Cierre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cierre = $this->cierreRepository->findWithoutFail($id);

        if (empty($cierre)) {
            Flash::error('Cierre not found');

            return redirect(route('cierre.index'));
        }

        return view('cierre.show')->with('cierre', $cierre);
    }

    /**
     * Show the form for editing the specified Cierre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cierre = $this->cierreRepository->findWithoutFail($id);

        if (empty($cierre)) {
            Flash::error('Cierre not found');

            return redirect(route('cierre.index'));
        }

        return view('cierre.edit')->with('cierre', $cierre);
    }

    /**
     * Update the specified Cierre in storage.
     *
     * @param  int              $id
     * @param UpdateCierreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCierreRequest $request)
    {
        $cierre = $this->cierreRepository->findWithoutFail($id);

        if (empty($cierre)) {
            Flash::error('Cierre not found');

            return redirect(route('cierre.index'));
        }

        $cierre = $this->cierreRepository->update($request->all(), $id);

        Flash::success('Cierre updated successfully.');

        return redirect(route('cierre.index'));
    }

    /**
     * Remove the specified Cierre from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cierre = $this->cierreRepository->findWithoutFail($id);

        if (empty($cierre)) {
            Flash::error('Cierre not found');

            return redirect(route('cierre.index'));
        }

        $this->cierreRepository->delete($id);

        Flash::success('Cierre deleted successfully.');

        return redirect(route('cierre.index'));
    }
}
