<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMetodoPagoAPIRequest;
use App\Http\Requests\API\UpdateMetodoPagoAPIRequest;
use App\Models\MetodoPago;
use App\Repositories\MetodoPagoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MetodoPagoController
 * @package App\Http\Controllers\API
 */

class MetodoPagoAPIController extends AppBaseController
{
    /** @var  MetodoPagoRepository */
    private $metodoPagoRepository;

    public function __construct(MetodoPagoRepository $metodoPagoRepo)
    {
        $this->metodoPagoRepository = $metodoPagoRepo;
    }

    /**
     * Display a listing of the MetodoPago.
     * GET|HEAD /metodoPagos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->metodoPagoRepository->pushCriteria(new RequestCriteria($request));
        $this->metodoPagoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $metodoPagos = $this->metodoPagoRepository->all();

        return $this->sendResponse($metodoPagos->toArray(), 'Metodo Pagos mostrado con exito');
    }

    /**
     * Store a newly created MetodoPago in storage.
     * POST /metodoPagos
     *
     * @param CreateMetodoPagoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMetodoPagoAPIRequest $request)
    {
        $input = $request->all();

        $metodoPagos = $this->metodoPagoRepository->create($input);

        return $this->sendResponse($metodoPagos->toArray(), 'Metodo Pago guardado con exito');
    }

    /**
     * Display the specified MetodoPago.
     * GET|HEAD /metodoPagos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MetodoPago $metodoPago */
        $metodoPago = $this->metodoPagoRepository->findWithoutFail($id);

        if (empty($metodoPago)) {
            return $this->sendError('Metodo Pago no encontrado');
        }

        return $this->sendResponse($metodoPago->toArray(), 'Metodo Pago mostrado con exito');
    }

    /**
     * Update the specified MetodoPago in storage.
     * PUT/PATCH /metodoPagos/{id}
     *
     * @param  int $id
     * @param UpdateMetodoPagoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMetodoPagoAPIRequest $request)
    {
        $input = $request->all();

        /** @var MetodoPago $metodoPago */
        $metodoPago = $this->metodoPagoRepository->findWithoutFail($id);

        if (empty($metodoPago)) {
            return $this->sendError('Metodo Pago no encontrado');
        }

        $metodoPago = $this->metodoPagoRepository->update($input, $id);

        return $this->sendResponse($metodoPago->toArray(), 'MetodoPago actualizado con exito');
    }

    /**
     * Remove the specified MetodoPago from storage.
     * DELETE /metodoPagos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MetodoPago $metodoPago */
        $metodoPago = $this->metodoPagoRepository->findWithoutFail($id);

        if (empty($metodoPago)) {
            return $this->sendError('Metodo Pago no encontrado');
        }

        $metodoPago->delete();

        return $this->sendResponse($id, 'Metodo Pago borrado con exito');
    }
}
