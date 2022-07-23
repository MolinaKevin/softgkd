<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTipoPagoAPIRequest;
use App\Http\Requests\API\UpdateTipoPagoAPIRequest;
use App\Models\TipoPago;
use App\Repositories\TipoPagoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TipoPagoController
 * @package App\Http\Controllers\API
 */

class TipoPagoAPIController extends AppBaseController
{
    /** @var  TipoPagoRepository */
    private $tipoPagoRepository;

    public function __construct(TipoPagoRepository $tipoPagoRepo)
    {
        $this->tipoPagoRepository = $tipoPagoRepo;
    }

    /**
     * Display a listing of the TipoPago.
     * GET|HEAD /tipoPagos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoPagoRepository->pushCriteria(new RequestCriteria($request));
        $this->tipoPagoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tipoPagos = $this->tipoPagoRepository->all();

        return $this->sendResponse($tipoPagos->toArray(), 'Tipo Pagos mostrado con exito');
    }

    /**
     * Store a newly created TipoPago in storage.
     * POST /tipoPagos
     *
     * @param CreateTipoPagoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoPagoAPIRequest $request)
    {
        $input = $request->all();

        $tipoPagos = $this->tipoPagoRepository->create($input);

        return $this->sendResponse($tipoPagos->toArray(), 'Tipo Pago guardado con exito');
    }

    /**
     * Display the specified TipoPago.
     * GET|HEAD /tipoPagos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TipoPago $tipoPago */
        $tipoPago = $this->tipoPagoRepository->findWithoutFail($id);

        if (empty($tipoPago)) {
            return $this->sendError('Tipo Pago no encontrado');
        }

        return $this->sendResponse($tipoPago->toArray(), 'Tipo Pago mostrado con exito');
    }

    /**
     * Update the specified TipoPago in storage.
     * PUT/PATCH /tipoPagos/{id}
     *
     * @param  int $id
     * @param UpdateTipoPagoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoPagoAPIRequest $request)
    {
        $input = $request->all();

        /** @var TipoPago $tipoPago */
        $tipoPago = $this->tipoPagoRepository->findWithoutFail($id);

        if (empty($tipoPago)) {
            return $this->sendError('Tipo Pago no encontrado');
        }

        $tipoPago = $this->tipoPagoRepository->update($input, $id);

        return $this->sendResponse($tipoPago->toArray(), 'TipoPago actualizado con exito');
    }

    /**
     * Remove the specified TipoPago from storage.
     * DELETE /tipoPagos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TipoPago $tipoPago */
        $tipoPago = $this->tipoPagoRepository->findWithoutFail($id);

        if (empty($tipoPago)) {
            return $this->sendError('Tipo Pago no encontrado');
        }

        $tipoPago->delete();

        return $this->sendResponse($id, 'Tipo Pago borrado con exito');
    }
}
