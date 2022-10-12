<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCierresAPIRequest;
use App\Http\Requests\API\UpdateCierresAPIRequest;
use App\Models\Cierre;
use App\Repositories\CierresRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CierresController
 * @package App\Http\Controllers\API
 */

class CierresAPIController extends AppBaseController
{
    /** @var  CierresRepository */
    private $cierresRepository;

    public function __construct(CierresRepository $cierresRepo)
    {
        $this->cierresRepository = $cierresRepo;
    }

    /**
     * Display a listing of the Cierres.
     * GET|HEAD /cierres
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->cierresRepository->pushCriteria(new RequestCriteria($request));
        $this->cierresRepository->pushCriteria(new LimitOffsetCriteria($request));
        $cierres = $this->cierresRepository->all();

        return $this->sendResponse($cierres->toArray(), 'Cierres mostrado con exito');
    }

    /**
     * Store a newly created Cierres in storage.
     * POST /cierres
     *
     * @param CreateCierresAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCierresAPIRequest $request)
    {
        $input = $request->all();

        $cierres = $this->cierresRepository->create($input);

        return $this->sendResponse($cierres->toArray(), 'Cierres guardado con exito');
    }

    /**
     * Display the specified Cierres.
     * GET|HEAD /cierres/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Cierres $cierres */
        $cierres = $this->cierresRepository->findWithoutFail($id);

        if (empty($cierres)) {
            return $this->sendError('Cierres no encontrado');
        }

        return $this->sendResponse($cierres->toArray(), 'Cierres mostrado con exito');
    }

    /**
     * Update the specified Cierres in storage.
     * PUT/PATCH /cierres/{id}
     *
     * @param  int $id
     * @param UpdateCierresAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCierresAPIRequest $request)
    {
        $input = $request->all();

        /** @var Cierres $cierres */
        $cierres = $this->cierresRepository->findWithoutFail($id);

        if (empty($cierres)) {
            return $this->sendError('Cierres no encontrado');
        }

        $cierres = $this->cierresRepository->update($input, $id);

        return $this->sendResponse($cierres->toArray(), 'Cierres actualizado con exito');
    }

    /**
     * Remove the specified Cierres from storage.
     * DELETE /cierres/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Cierres $cierres */
        $cierres = $this->cierresRepository->findWithoutFail($id);

        if (empty($cierres)) {
            return $this->sendError('Cierres no encontrado');
        }

        $cierres->delete();

        return $this->sendResponse($id, 'Cierres borrado con exito');
    }
}
