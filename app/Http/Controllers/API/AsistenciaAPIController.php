<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAsistenciaAPIRequest;
use App\Http\Requests\API\UpdateAsistenciaAPIRequest;
use App\Models\Asistencia;
use App\Models\Dispositivo;
use App\Repositories\AsistenciaRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AsistenciaController
 * @package App\Http\Controllers\API
 */

class AsistenciaAPIController extends AppBaseController
{
    /** @var  AsistenciaRepository */
    private $asistenciaRepository;

    public function __construct(AsistenciaRepository $asistenciaRepo)
    {
        $this->asistenciaRepository = $asistenciaRepo;
    }

    /**
     * Display a listing of the Asistencia.
     * GET|HEAD /asistencias
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->asistenciaRepository->pushCriteria(new RequestCriteria($request));
        $this->asistenciaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $asistencias = $this->asistenciaRepository->all();

        return $this->sendResponse($asistencias->toArray(), 'Asistencias mostrado con exito');
    }

    /**
     * Store a newly created Asistencia in storage.
     * POST /asistencias
     *
     * @param CreateAsistenciaAPIRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Log::debug($input);
        foreach ($input as $item) {
            $asistencia = [];
            $asistencia['user_id'] = $item['credencial'];
            $asistencia['horario'] = Carbon::parse($item['horario']);
            if (isset($item['id'])) {
                $asistencia['dispositivo_id'] = $item['id'];
            } else {
                $asistencia['dispositivo_id'] = 1;
            }
            $this->asistenciaRepository->create($asistencia);
        }

        return response("Success//",200);
    }

    /**
     * Display the specified Asistencia.
     * GET|HEAD /asistencias/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Asistencia $asistencia */
        $asistencia = $this->asistenciaRepository->findWithoutFail($id);

        if (empty($asistencia)) {
            return $this->sendError('Asistencia no encontrado');
        }

        return $this->sendResponse($asistencia->toArray(), 'Asistencia mostrado con exito');
    }

    /**
     * Update the specified Asistencia in storage.
     * PUT/PATCH /asistencias/{id}
     *
     * @param  int $id
     * @param UpdateAsistenciaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAsistenciaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Asistencia $asistencia */
        $asistencia = $this->asistenciaRepository->findWithoutFail($id);

        if (empty($asistencia)) {
            return $this->sendError('Asistencia no encontrado');
        }

        $asistencia = $this->asistenciaRepository->update($input, $id);

        return $this->sendResponse($asistencia->toArray(), 'Asistencia actualizado con exito');
    }

    /**
     * Remove the specified Asistencia from storage.
     * DELETE /asistencias/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Asistencia $asistencia */
        $asistencia = $this->asistenciaRepository->findWithoutFail($id);

        if (empty($asistencia)) {
            return $this->sendError('Asistencia no encontrado');
        }

        $asistencia->delete();

        return $this->sendResponse($id, 'Asistencia borrado con exito');
    }
}
