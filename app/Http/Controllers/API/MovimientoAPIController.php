<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMovimientoAPIRequest;
use App\Http\Requests\API\UpdateMovimientoAPIRequest;
use App\Models\Movimiento;
use App\Repositories\MovimientoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MovimientoController
 * @package App\Http\Controllers\API
 */

class MovimientoAPIController extends AppBaseController
{
    /** @var  MovimientoRepository */
    private $movimientoRepository;

    public function __construct(MovimientoRepository $movimientoRepo)
    {
        $this->movimientoRepository = $movimientoRepo;
    }

    /**
     * Display a listing of the Movimiento.
     * GET|HEAD /movimientos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->movimientoRepository->pushCriteria(new RequestCriteria($request));
        $this->movimientoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $movimientos = $this->movimientoRepository->all();

        return $this->sendResponse($movimientos->toArray(), 'Movimientos mostrado con exito');
    }

    /**
     * Store a newly created Movimiento in storage.
     * POST /movimientos
     *
     * @param CreateMovimientoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMovimientoAPIRequest $request)
    {
        $input = $request->all();

        $movimientos = $this->movimientoRepository->create($input);

        return $this->sendResponse($movimientos->toArray(), 'Movimiento guardado con exito');
    }

    /**
     * Display the specified Movimiento.
     * GET|HEAD /movimientos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Movimiento $movimiento */
        $movimiento = $this->movimientoRepository->findWithoutFail($id);

        if (empty($movimiento)) {
            return $this->sendError('Movimiento no encontrado');
        }

        return $this->sendResponse($movimiento->toArray(), 'Movimiento mostrado con exito');
    }

    /**
     * Update the specified Movimiento in storage.
     * PUT/PATCH /movimientos/{id}
     *
     * @param  int $id
     * @param UpdateMovimientoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMovimientoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Movimiento $movimiento */
        $movimiento = $this->movimientoRepository->findWithoutFail($id);

        if (empty($movimiento)) {
            return $this->sendError('Movimiento no encontrado');
        }

        $movimiento = $this->movimientoRepository->update($input, $id);

        return $this->sendResponse($movimiento->toArray(), 'Movimiento actualizado con exito');
    }

    /**
     * Remove the specified Movimiento from storage.
     * DELETE /movimientos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Movimiento $movimiento */
        $movimiento = $this->movimientoRepository->findWithoutFail($id);

        if (empty($movimiento)) {
            return $this->sendError('Movimiento no encontrado');
        }

        $movimiento->delete();

        return $this->sendResponse($id, 'Movimiento borrado con exito');
    }
}
