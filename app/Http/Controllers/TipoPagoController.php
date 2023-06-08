<?php

namespace App\Http\Controllers;

use App\DataTables\TipoPagoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTipoPagoRequest;
use App\Http\Requests\UpdateTipoPagoRequest;
use App\Repositories\TipoPagoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TipoPagoController extends AppBaseController
{
    /** @var  TipoPagoRepository */
    private $tipoPagoRepository;

    public function __construct(TipoPagoRepository $tipoPagoRepo)
    {
        $this->tipoPagoRepository = $tipoPagoRepo;
    }

    /**
     * Display a listing of the TipoPago.
     *
     * @param TipoPagoDataTable $tipoPagoDataTable
     * @return Response
     */
    public function index(TipoPagoDataTable $tipoPagoDataTable)
    {
        return $tipoPagoDataTable->render('tipo_pagos.index');
    }

    /**
     * Show the form for creating a new TipoPago.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_pagos.create');
    }

    /**
     * Store a newly created TipoPago in storage.
     *
     * @param CreateTipoPagoRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoPagoRequest $request)
    {
        $input = $request->all();

        $tipoPago = $this->tipoPagoRepository->create($input);

        Flash::success('Tipo Pago saved successfully.');

        return redirect(route('tipoPagos.index'));
    }

    /**
     * Display the specified TipoPago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoPago = $this->tipoPagoRepository->findWithoutFail($id);

        if (empty($tipoPago)) {
            Flash::error('Tipo Pago not found');

            return redirect(route('tipoPagos.index'));
        }

        return view('tipo_pagos.show')->with('tipoPago', $tipoPago);
    }

    /**
     * Show the form for editing the specified TipoPago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoPago = $this->tipoPagoRepository->findWithoutFail($id);

        if (empty($tipoPago)) {
            Flash::error('Tipo Pago not found');

            return redirect(route('tipoPagos.index'));
        }

        return view('tipo_pagos.edit')->with('tipoPago', $tipoPago);
    }

    /**
     * Update the specified TipoPago in storage.
     *
     * @param  int              $id
     * @param UpdateTipoPagoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoPagoRequest $request)
    {
        $tipoPago = $this->tipoPagoRepository->findWithoutFail($id);

        if (empty($tipoPago)) {
            Flash::error('Tipo Pago not found');

            return redirect(route('tipoPagos.index'));
        }

        $tipoPago = $this->tipoPagoRepository->update($request->all(), $id);

        Flash::success('Tipo Pago updated successfully.');

        return redirect(route('tipoPagos.index'));
    }

    /**
     * Remove the specified TipoPago from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoPago = $this->tipoPagoRepository->findWithoutFail($id);

        if (empty($tipoPago)) {
            Flash::error('Tipo Pago not found');

            return redirect(route('tipoPagos.index'));
        }

        $this->tipoPagoRepository->delete($id);

        Flash::success('Tipo Pago deleted successfully.');

        return redirect(route('tipoPagos.index'));
    }
}
