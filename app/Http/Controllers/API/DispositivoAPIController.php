<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDispositivoAPIRequest;
use App\Http\Requests\API\UpdateDispositivoAPIRequest;
use App\Models\Dispositivo;
use App\Repositories\DispositivoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DispositivoController
 * @package App\Http\Controllers\API
 */

class DispositivoAPIController extends AppBaseController
{
    /** @var  DispositivoRepository */
    private $dispositivoRepository;

    public function __construct(DispositivoRepository $dispositivoRepo)
    {
        $this->dispositivoRepository = $dispositivoRepo;
    }

    /**
     * Display a listing of the Dispositivo.
     * GET|HEAD /dispositivos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->dispositivoRepository->pushCriteria(new RequestCriteria($request));
        $this->dispositivoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $dispositivos = $this->dispositivoRepository->all();

        return $this->sendResponse($dispositivos->toArray(), 'Dispositivos mostrado con exito');
    }

    /**
     * Store a newly created Dispositivo in storage.
     * POST /dispositivos
     *
     * @param CreateDispositivoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDispositivoAPIRequest $request)
    {
        $input = $request->all();

        $dispositivos = $this->dispositivoRepository->create($input);

        return $this->sendResponse($dispositivos->toArray(), 'Dispositivo guardado con exito');
    }

    /**
     * Display the specified Dispositivo.
     * GET|HEAD /dispositivos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Dispositivo $dispositivo */
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            return $this->sendError('Dispositivo no encontrado');
        }

        return $this->sendResponse($dispositivo->toArray(), 'Dispositivo mostrado con exito');
    }

    /**
     * Update the specified Dispositivo in storage.
     * PUT/PATCH /dispositivos/{id}
     *
     * @param  int $id
     * @param UpdateDispositivoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDispositivoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Dispositivo $dispositivo */
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            return $this->sendError('Dispositivo no encontrado');
        }

        $dispositivo = $this->dispositivoRepository->update($input, $id);

        return $this->sendResponse($dispositivo->toArray(), 'Dispositivo actualizado con exito');
    }

    /**
     * Remove the specified Dispositivo from storage.
     * DELETE /dispositivos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Dispositivo $dispositivo */
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            return $this->sendError('Dispositivo no encontrado');
        }

        $dispositivo->delete();

        return $this->sendResponse($id, 'Dispositivo borrado con exito');
    }

    public function moduloPersonalizado() {
        return 'aa';
    }
}
