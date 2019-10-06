<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateConexionAPIRequest;
use App\Http\Requests\API\UpdateConexionAPIRequest;
use App\Models\Conexion;
use App\Repositories\ConexionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ConexionController
 * @package App\Http\Controllers\API
 */

class ConexionAPIController extends AppBaseController
{
    /** @var  ConexionRepository */
    private $conexionRepository;

    public function __construct(ConexionRepository $conexionRepo)
    {
        $this->conexionRepository = $conexionRepo;
    }

    /**
     * Display a listing of the Conexion.
     * GET|HEAD /conexions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->conexionRepository->pushCriteria(new RequestCriteria($request));
        $this->conexionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $conexions = $this->conexionRepository->all();

        return $this->sendResponse($conexions->toArray(), 'Conexions mostrado con exito');
    }

    /**
     * Store a newly created Conexion in storage.
     * POST /conexions
     *
     * @param CreateConexionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateConexionAPIRequest $request)
    {
        $input = $request->all();

        $conexions = $this->conexionRepository->create($input);

        return $this->sendResponse($conexions->toArray(), 'Conexion guardado con exito');
    }

    /**
     * Display the specified Conexion.
     * GET|HEAD /conexions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Conexion $conexion */
        $conexion = $this->conexionRepository->findWithoutFail($id);

        if (empty($conexion)) {
            return $this->sendError('Conexion no encontrado');
        }

        return $this->sendResponse($conexion->toArray(), 'Conexion mostrado con exito');
    }

    /**
     * Update the specified Conexion in storage.
     * PUT/PATCH /conexions/{id}
     *
     * @param  int $id
     * @param UpdateConexionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConexionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Conexion $conexion */
        $conexion = $this->conexionRepository->findWithoutFail($id);

        if (empty($conexion)) {
            return $this->sendError('Conexion no encontrado');
        }

        $conexion = $this->conexionRepository->update($input, $id);

        return $this->sendResponse($conexion->toArray(), 'Conexion actualizado con exito');
    }

    /**
     * Remove the specified Conexion from storage.
     * DELETE /conexions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Conexion $conexion */
        $conexion = $this->conexionRepository->findWithoutFail($id);

        if (empty($conexion)) {
            return $this->sendError('Conexion no encontrado');
        }

        $conexion->delete();

        return $this->sendResponse($id, 'Conexion borrado con exito');
    }
}
