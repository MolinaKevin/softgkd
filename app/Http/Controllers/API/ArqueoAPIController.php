<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateArqueoAPIRequest;
use App\Http\Requests\API\UpdateArqueoAPIRequest;
use App\Models\Arqueo;
use App\Repositories\ArqueoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ArqueoController
 * @package App\Http\Controllers\API
 */

class ArqueoAPIController extends AppBaseController
{
    /** @var  ArqueoRepository */
    private $arqueoRepository;

    public function __construct(ArqueoRepository $arqueoRepo)
    {
        $this->arqueoRepository = $arqueoRepo;
    }

    /**
     * Display a listing of the Arqueo.
     * GET|HEAD /arqueos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->arqueoRepository->pushCriteria(new RequestCriteria($request));
        $this->arqueoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $arqueos = $this->arqueoRepository->all();

        return $this->sendResponse($arqueos->toArray(), 'Arqueos mostrado con exito');
    }

    /**
     * Store a newly created Arqueo in storage.
     * POST /arqueos
     *
     * @param CreateArqueoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateArqueoAPIRequest $request)
    {
        $input = $request->all();

        $arqueos = $this->arqueoRepository->create($input);

        return $this->sendResponse($arqueos->toArray(), 'Arqueo guardado con exito');
    }

    /**
     * Display the specified Arqueo.
     * GET|HEAD /arqueos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Arqueo $arqueo */
        $arqueo = $this->arqueoRepository->findWithoutFail($id);

        if (empty($arqueo)) {
            return $this->sendError('Arqueo no encontrado');
        }

        return $this->sendResponse($arqueo->toArray(), 'Arqueo mostrado con exito');
    }

    /**
     * Update the specified Arqueo in storage.
     * PUT/PATCH /arqueos/{id}
     *
     * @param  int $id
     * @param UpdateArqueoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArqueoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Arqueo $arqueo */
        $arqueo = $this->arqueoRepository->findWithoutFail($id);

        if (empty($arqueo)) {
            return $this->sendError('Arqueo no encontrado');
        }

        $arqueo = $this->arqueoRepository->update($input, $id);

        return $this->sendResponse($arqueo->toArray(), 'Arqueo actualizado con exito');
    }

    /**
     * Remove the specified Arqueo from storage.
     * DELETE /arqueos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Arqueo $arqueo */
        $arqueo = $this->arqueoRepository->findWithoutFail($id);

        if (empty($arqueo)) {
            return $this->sendError('Arqueo no encontrado');
        }

        $arqueo->delete();

        return $this->sendResponse($id, 'Arqueo borrado con exito');
    }
}
