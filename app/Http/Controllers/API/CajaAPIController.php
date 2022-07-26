<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCajaAPIRequest;
use App\Http\Requests\API\UpdateCajaAPIRequest;
use App\Models\Caja;
use App\Repositories\CajaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CajaController
 * @package App\Http\Controllers\API
 */

class CajaAPIController extends AppBaseController
{
    /** @var  CajaRepository */
    private $cajaRepository;

    public function __construct(CajaRepository $cajaRepo)
    {
        $this->cajaRepository = $cajaRepo;
    }

    /**
     * Display a listing of the Caja.
     * GET|HEAD /cajas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->cajaRepository->pushCriteria(new RequestCriteria($request));
        $this->cajaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $cajas = $this->cajaRepository->all();

        return $this->sendResponse($cajas->toArray(), 'Cajas mostrado con exito');
    }

    /**
     * Store a newly created Caja in storage.
     * POST /cajas
     *
     * @param CreateCajaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCajaAPIRequest $request)
    {
        $input = $request->all();

        $cajas = $this->cajaRepository->create($input);

        return $this->sendResponse($cajas->toArray(), 'Caja guardado con exito');
    }

    /**
     * Display the specified Caja.
     * GET|HEAD /cajas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Caja $caja */
        $caja = $this->cajaRepository->findWithoutFail($id);

        if (empty($caja)) {
            return $this->sendError('Caja no encontrado');
        }

        return $this->sendResponse($caja->toArray(), 'Caja mostrado con exito');
    }

    /**
     * Update the specified Caja in storage.
     * PUT/PATCH /cajas/{id}
     *
     * @param  int $id
     * @param UpdateCajaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCajaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Caja $caja */
        $caja = $this->cajaRepository->findWithoutFail($id);

        if (empty($caja)) {
            return $this->sendError('Caja no encontrado');
        }

        $caja = $this->cajaRepository->update($input, $id);

        return $this->sendResponse($caja->toArray(), 'Caja actualizado con exito');
    }

    public function abrir($id, Request $request)
    {
        
        $input = $request->all();

        /** @var Caja $caja */
        $caja = $this->cajaRepository->findWithoutFail($id);

        if (empty($caja)) {
            return $this->sendError('Caja no encontrado');
        }

        $caja->abrir($input['user']);

        return $this->sendResponse($caja->toArray(), 'Caja abierta con exito');
    }

    public function cerrar($id)
    {

        /** @var Caja $caja */
        $caja = $this->cajaRepository->findWithoutFail($id);

        if (empty($caja)) {
            return $this->sendError('Caja no encontrado');
        }

        $caja->cerrar();

        return $this->sendResponse($caja->toArray(), 'Caja cerrada con exito');
    }


    /**
     * Remove the specified Caja from storage.
     * DELETE /cajas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Caja $caja */
        $caja = $this->cajaRepository->findWithoutFail($id);

        if (empty($caja)) {
            return $this->sendError('Caja no encontrado');
        }

        $caja->delete();

        return $this->sendResponse($id, 'Caja borrado con exito');
    }
}
