<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFamiliaAPIRequest;
use App\Http\Requests\API\UpdateFamiliaAPIRequest;
use App\Models\Familia;
use App\Repositories\FamiliaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FamiliaController
 * @package App\Http\Controllers\API
 */

class FamiliaAPIController extends AppBaseController
{
    /** @var  FamiliaRepository */
    private $familiaRepository;

    public function __construct(FamiliaRepository $familiaRepo)
    {
        $this->familiaRepository = $familiaRepo;
    }

    /**
     * Display a listing of the Familia.
     * GET|HEAD /familias
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->familiaRepository->pushCriteria(new RequestCriteria($request));
        $this->familiaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $familias = $this->familiaRepository->all();

        return $this->sendResponse($familias->toArray(), 'Familias retrieved successfully');
    }

    /**
     * Store a newly created Familia in storage.
     * POST /familias
     *
     * @param CreateFamiliaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFamiliaAPIRequest $request)
    {
        $input = $request->all();

        $familias = $this->familiaRepository->create($input);

        return $this->sendResponse($familias->toArray(), 'Familia guardada');
    }

    /**
     * Display the specified Familia.
     * GET|HEAD /familias/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Familia $familia */
        $familia = $this->familiaRepository->findWithoutFail($id);

        if (empty($familia)) {
            return $this->sendError('Familia not found');
        }

        return $this->sendResponse($familia->toArray(), 'Familia retrieved successfully');
    }

    /**
     * Update the specified Familia in storage.
     * PUT/PATCH /familias/{id}
     *
     * @param  int $id
     * @param UpdateFamiliaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFamiliaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Familia $familia */
        $familia = $this->familiaRepository->findWithoutFail($id);

        if (empty($familia)) {
            return $this->sendError('Familia not found');
        }

        $familia = $this->familiaRepository->update($input, $id);

        return $this->sendResponse($familia->toArray(), 'Familia updated successfully');
    }

    /**
     * Remove the specified Familia from storage.
     * DELETE /familias/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Familia $familia */
        $familia = $this->familiaRepository->findWithoutFail($id);

        if (empty($familia)) {
            return $this->sendError('Familia not found');
        }

        $familia->delete();

        return $this->sendResponse($id, 'Familia deleted successfully');
    }
}
