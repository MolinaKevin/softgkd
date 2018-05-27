<?php

namespace App\Http\Controllers;

use App\DataTables\HuellaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateHuellaRequest;
use App\Http\Requests\UpdateHuellaRequest;
use App\Repositories\HuellaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class HuellaController extends AppBaseController
{
    /** @var  HuellaRepository */
    private $huellaRepository;

    public function __construct(HuellaRepository $huellaRepo)
    {
        $this->huellaRepository = $huellaRepo;
    }

    /**
     * Display a listing of the Huella.
     *
     * @param HuellaDataTable $huellaDataTable
     * @return Response
     */
    public function index(HuellaDataTable $huellaDataTable)
    {
        return $huellaDataTable->render('huellas.index');
    }

    /**
     * Show the form for creating a new Huella.
     *
     * @return Response
     */
    public function create()
    {
        return view('huellas.create');
    }

    /**
     * Store a newly created Huella in storage.
     *
     * @param CreateHuellaRequest $request
     *
     * @return Response
     */
    public function store(CreateHuellaRequest $request)
    {
        $input = $request->all();

        $huella = $this->huellaRepository->create($input);

        Flash::success('Huella saved successfully.');

        return redirect(route('huellas.index'));
    }

    /**
     * Display the specified Huella.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $huella = $this->huellaRepository->findWithoutFail($id);

        if (empty($huella)) {
            Flash::error('Huella not found');

            return redirect(route('huellas.index'));
        }

        return view('huellas.show')->with('huella', $huella);
    }

    /**
     * Show the form for editing the specified Huella.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $huella = $this->huellaRepository->findWithoutFail($id);

        if (empty($huella)) {
            Flash::error('Huella not found');

            return redirect(route('huellas.index'));
        }

        return view('huellas.edit')->with('huella', $huella);
    }

    /**
     * Update the specified Huella in storage.
     *
     * @param  int              $id
     * @param UpdateHuellaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHuellaRequest $request)
    {
        $huella = $this->huellaRepository->findWithoutFail($id);

        if (empty($huella)) {
            Flash::error('Huella not found');

            return redirect(route('huellas.index'));
        }

        $huella = $this->huellaRepository->update($request->all(), $id);

        Flash::success('Huella updated successfully.');

        return redirect(route('huellas.index'));
    }

    /**
     * Remove the specified Huella from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $huella = $this->huellaRepository->findWithoutFail($id);

        if (empty($huella)) {
            Flash::error('Huella not found');

            return redirect(route('huellas.index'));
        }

        $this->huellaRepository->delete($id);

        Flash::success('Huella deleted successfully.');

        return redirect(route('huellas.index'));
    }
}
