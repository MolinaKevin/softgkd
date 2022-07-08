<?php

namespace App\Http\Controllers;

use App\DataTables\MetodoPagoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMetodoPagoRequest;
use App\Http\Requests\UpdateMetodoPagoRequest;
use App\Repositories\MetodoPagoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MetodoPagoController extends AppBaseController
{
    /** @var  MetodoPagoRepository */
    private $metodoPagoRepository;

    public function __construct(MetodoPagoRepository $metodoPagoRepo)
    {
        $this->metodoPagoRepository = $metodoPagoRepo;
    }

    /**
     * Display a listing of the MetodoPago.
     *
     * @param MetodoPagoDataTable $metodoPagoDataTable
     * @return Response
     */
    public function index(MetodoPagoDataTable $metodoPagoDataTable)
    {
        return $metodoPagoDataTable->render('metodoPagos.index');
    }

    /**
     * Show the form for creating a new MetodoPago.
     *
     * @return Response
     */
    public function create()
    {
        return view('metodo_pagos.create');
    }

    /**
     * Store a newly created MetodoPago in storage.
     *
     * @param CreateMetodoPagoRequest $request
     *
     * @return Response
     */
    public function store(CreateMetodoPagoRequest $request)
    {
        $input = $request->all();

        dd($input);

        $metodoPago = $this->metodoPagoRepository->create($input);

        Flash::success('Metodo Pago saved successfully.');

        return redirect(route('metodoPagos.index'));
    }

    /**
     * Display the specified MetodoPago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $metodoPago = $this->metodoPagoRepository->findWithoutFail($id);

        if (empty($metodoPago)) {
            Flash::error('Metodo Pago not found');

            return redirect(route('metodoPagos.index'));
        }

        return view('metodo_pagos.show')->with('metodoPago', $metodoPago);
    }

    /**
     * Show the form for editing the specified MetodoPago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $metodoPago = $this->metodoPagoRepository->findWithoutFail($id);

        if (empty($metodoPago)) {
            Flash::error('Metodo Pago not found');

            return redirect(route('metodoPagos.index'));
        }

        return view('metodo_pagos.edit')->with('metodoPago', $metodoPago);
    }

    /**
     * Update the specified MetodoPago in storage.
     *
     * @param  int              $id
     * @param UpdateMetodoPagoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMetodoPagoRequest $request)
    {
        $metodoPago = $this->metodoPagoRepository->findWithoutFail($id);

        if (empty($metodoPago)) {
            Flash::error('Metodo Pago not found');

            return redirect(route('metodoPagos.index'));
        }

        $metodoPago = $this->metodoPagoRepository->update($request->all(), $id);

        Flash::success('Metodo Pago updated successfully.');

        return redirect(route('metodoPagos.index'));
    }

    /**
     * Remove the specified MetodoPago from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $metodoPago = $this->metodoPagoRepository->findWithoutFail($id);

        if (empty($metodoPago)) {
            Flash::error('Metodo Pago not found');

            return redirect(route('metodoPagos.index'));
        }

        $this->metodoPagoRepository->delete($id);

        Flash::success('Metodo Pago deleted successfully.');

        return redirect(route('metodoPagos.index'));
    }
}
