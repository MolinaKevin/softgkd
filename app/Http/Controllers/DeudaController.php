<?php

namespace App\Http\Controllers;

use App\DataTables\DeudaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDeudaRequest;
use App\Http\Requests\UpdateDeudaRequest;
use App\Repositories\DeudaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DeudaController extends AppBaseController
{
    /** @var  DeudaRepository */
    private $deudaRepository;

    public function __construct(DeudaRepository $deudaRepo)
    {
        $this->middleware('permission:deudas.index')->only('index');
        $this->middleware('permission:deudas.create')->only(['create','store']);
        $this->middleware('permission:deudas.edit')->only(['edit','update']);
        $this->middleware('permission:deudas.show')->only('show');
        $this->middleware('permission:deudas.destroy')->only('destroy');
        $this->deudaRepository = $deudaRepo;
    }

    /**
     * Display a listing of the Deuda.
     *
     * @param DeudaDataTable $deudaDataTable
     * @return Response
     */
    public function index(DeudaDataTable $deudaDataTable)
    {
        return $deudaDataTable->render('deudas.index');
    }

    /**
     * Show the form for creating a new Deuda.
     *
     * @return Response
     */
    public function create()
    {
        return view('deudas.create');
    }

    /**
     * Store a newly created Deuda in storage.
     *
     * @param CreateDeudaRequest $request
     *
     * @return Response
     */
    public function store(CreateDeudaRequest $request)
    {
        $input = $request->all();

        $deuda = $this->deudaRepository->create($input);

        Flash::success('Deuda saved successfully.');

        return redirect(route('deudas.index'));
    }

    /**
     * Display the specified Deuda.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deuda = $this->deudaRepository->findWithoutFail($id);

        if (empty($deuda)) {
            Flash::error('Deuda not found');

            return redirect(route('deudas.index'));
        }

        return view('deudas.show')->with('deuda', $deuda);
    }

    /**
     * Show the form for editing the specified Deuda.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deuda = $this->deudaRepository->findWithoutFail($id);

        if (empty($deuda)) {
            Flash::error('Deuda not found');

            return redirect(route('deudas.index'));
        }

        return view('deudas.edit')->with('deuda', $deuda);
    }

    /**
     * Update the specified Deuda in storage.
     *
     * @param  int              $id
     * @param UpdateDeudaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeudaRequest $request)
    {
        $deuda = $this->deudaRepository->findWithoutFail($id);

        if (empty($deuda)) {
            Flash::error('Deuda not found');

            return redirect(route('deudas.index'));
        }

        $deuda = $this->deudaRepository->update($request->all(), $id);

        Flash::success('Deuda updated successfully.');

        return redirect(route('deudas.index'));
    }

    /**
     * Remove the specified Deuda from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deuda = $this->deudaRepository->findWithoutFail($id);

        if (empty($deuda)) {
            Flash::error('Deuda not found');

            return redirect(route('deudas.index'));
        }

        $this->deudaRepository->delete($id);

        Flash::success('Deuda deleted successfully.');

        return redirect(route('deudas.index'));
    }
}
