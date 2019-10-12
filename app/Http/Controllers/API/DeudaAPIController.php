<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDeudaAPIRequest;
use App\Http\Requests\API\UpdateDeudaAPIRequest;
use App\Models\Deuda;
use App\Repositories\DeudaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DeudaController
 * @package App\Http\Controllers\API
 */

class DeudaAPIController extends AppBaseController
{
    /** @var  DeudaRepository */
    private $deudaRepository;

    public function __construct(DeudaRepository $deudaRepo)
    {
        $this->deudaRepository = $deudaRepo;
    }

    /**
     * Display a listing of the Deuda.
     * GET|HEAD /deudas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->deudaRepository->pushCriteria(new RequestCriteria($request));
        $this->deudaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $deudas = $this->deudaRepository->all();

        return $this->sendResponse($deudas->toArray(), 'Deudas mostrado con exito');
    }

    /**
     * Store a newly created Deuda in storage.
     * POST /deudas
     *
     * @param CreateDeudaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDeudaAPIRequest $request)
    {
        $input = $request->all();

        $deudas = $this->deudaRepository->create($input);

        return $this->sendResponse($deudas->toArray(), 'Deuda guardado con exito');
    }

    /**
     * Display the specified Deuda.
     * GET|HEAD /deudas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Deuda $deuda */
        $deuda = $this->deudaRepository->findWithoutFail($id);

        if (empty($deuda)) {
            return $this->sendError('Deuda no encontrado');
        }

        return $this->sendResponse($deuda->toArray(), 'Deuda mostrado con exito');
    }

    /**
     * Update the specified Deuda in storage.
     * PUT/PATCH /deudas/{id}
     *
     * @param  int $id
     * @param UpdateDeudaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeudaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Deuda $deuda */
        $deuda = $this->deudaRepository->findWithoutFail($id);

        if (empty($deuda)) {
            return $this->sendError('Deuda no encontrado');
        }

        $deuda = $this->deudaRepository->update($input, $id);

        return $this->sendResponse($deuda->toArray(), 'Deuda actualizado con exito');
    }

    /**
     * Remove the specified Deuda from storage.
     * DELETE /deudas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Deuda $deuda */
        $deuda = $this->deudaRepository->findWithoutFail($id);

        if (empty($deuda)) {
            return $this->sendError('Deuda no encontrado');
        }

        $deuda->delete();

        return $this->sendResponse($id, 'Deuda borrado con exito');
    }

    public function eliminar(Request $request)
    {
        $deudas = $request->deudas;

        foreach ($deudas as $deudaId) {
            $deuda = $this->deudaRepository->findWithoutFail($deudaId);
            $deuda->delete();
        }


        return $this->sendResponse(true,'Deudas borradas con exito');
    }

}
