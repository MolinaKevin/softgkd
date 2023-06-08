<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLogAPIRequest;
use App\Http\Requests\API\UpdateLogAPIRequest;
use App\Models\Log;
use App\Repositories\LogRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LogController
 * @package App\Http\Controllers\API
 */

class LogAPIController extends AppBaseController
{
    /** @var  LogRepository */
    private $logRepository;

    public function __construct(LogRepository $logRepo)
    {
        $this->logRepository = $logRepo;
    }

    /**
     * Display a listing of the Log.
     * GET|HEAD /logs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->logRepository->pushCriteria(new RequestCriteria($request));
        $this->logRepository->pushCriteria(new LimitOffsetCriteria($request));
        $logs = $this->logRepository->all();

        return $this->sendResponse($logs->toArray(), 'Logs mostrado con exito');
    }

    /**
     * Store a newly created Log in storage.
     * POST /logs
     *
     * @param CreateLogAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLogAPIRequest $request)
    {
        $input = $request->all();

        $logs = $this->logRepository->create($input);

        return $this->sendResponse($logs->toArray(), 'Log guardado con exito');
    }

    /**
     * Display the specified Log.
     * GET|HEAD /logs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Log $log */
        $log = $this->logRepository->findWithoutFail($id);

        if (empty($log)) {
            return $this->sendError('Log no encontrado');
        }

        return $this->sendResponse($log->toArray(), 'Log mostrado con exito');
    }

    /**
     * Update the specified Log in storage.
     * PUT/PATCH /logs/{id}
     *
     * @param  int $id
     * @param UpdateLogAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLogAPIRequest $request)
    {
        $input = $request->all();

        /** @var Log $log */
        $log = $this->logRepository->findWithoutFail($id);

        if (empty($log)) {
            return $this->sendError('Log no encontrado');
        }

        $log = $this->logRepository->update($input, $id);

        return $this->sendResponse($log->toArray(), 'Log actualizado con exito');
    }

    /**
     * Remove the specified Log from storage.
     * DELETE /logs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Log $log */
        $log = $this->logRepository->findWithoutFail($id);

        if (empty($log)) {
            return $this->sendError('Log no encontrado');
        }

        $log->delete();

        return $this->sendResponse($id, 'Log borrado con exito');
    }
}
