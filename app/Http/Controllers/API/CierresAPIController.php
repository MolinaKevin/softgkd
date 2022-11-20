<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCierresAPIRequest;
use App\Http\Requests\API\UpdateCierresAPIRequest;
use App\Models\Cierre;
use App\Repositories\CierreRepository;
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
    /** @var  CierreRepository */
    private $cierreRepository;

    public function __construct(CierreRepository $cierreRepo)
    {
        $this->cierreRepository = $cierreRepo;
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
        $this->cierreRepository->pushCriteria(new RequestCriteria($request));
        $this->cierreRepository->pushCriteria(new LimitOffsetCriteria($request));
        $cierres = $this->cierreRepository->all();

        return $this->sendResponse($cierres->toArray(), 'Cierres mostrados con exito');
    }

    /**
     * Store a newly created Cierres in storage.
     * POST /cierre
     *
     * @param CreateCierresAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCierresAPIRequest $request)
    {
        $input = $request->all();

        $cierre = $this->cierreRepository->create($input);

        return $this->sendResponse($cierre->toArray(), 'Cierre guardado con exito');
    }

    /**
     * Display the specified Cierres.
     * GET|HEAD /cierre/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Cierres $cierres */
        $cierre = $this->cierreRepository->findWithoutFail($id);

        if (empty($cierre)) {
            return $this->sendError('Cierres no encontrado');
        }

        return $this->sendResponse($cierre->toArray(), 'Cierre mostrado con exito');
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
        $cierre = $this->cierreRepository->findWithoutFail($id);

        if (empty($cierre)) {
            return $this->sendError('Cierre no encontrado');
        }

        $cierre = $this->cierreRepository->update($input, $id);

        return $this->sendResponse($cierre->toArray(), 'Cierre actualizado con exito');
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
        $cierre = $this->cierreRepository->findWithoutFail($id);

        if (empty($cierre)) {
            return $this->sendError('Cierre no encontrado');
        }

        $cierre->delete();

        return $this->sendResponse($id, 'Cierre borrado con exito');
    }
}
