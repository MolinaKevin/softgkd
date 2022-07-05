<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePlanAPIRequest;
use App\Http\Requests\API\UpdatePlanAPIRequest;
use App\Models\Plan;
use App\Repositories\PlanRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PlanController
 * @package App\Http\Controllers\API
 */

class PlanAPIController extends AppBaseController
{
    /** @var  PlanRepository */
    private $planRepository;

    public function __construct(PlanRepository $planRepo)
    {
        $this->planRepository = $planRepo;
    }

    /**
     * Display a listing of the Plan.
     * GET|HEAD /plans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->planRepository->pushCriteria(new RequestCriteria($request));
        $this->planRepository->pushCriteria(new LimitOffsetCriteria($request));
        $plans = $this->planRepository->all();

        return $this->sendResponse($plans->toArray(), 'Plans mostrado con exito');
    }

    /**
     * Store a newly created Plan in storage.
     * POST /plans
     *
     * @param CreatePlanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanAPIRequest $request)
    {
        $input = $request->all();

        $plans = $this->planRepository->create($input);

        return $this->sendResponse($plans->toArray(), 'Plan guardado con exito');
    }

    /**
     * Display the specified Plan.
     * GET|HEAD /plans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Plan $plan */
        $plan = $this->planRepository->findWithoutFail($id);

        if (empty($plan)) {
            return $this->sendError('Plan no encontrado');
        }

        return $this->sendResponse($plan->toArray(), 'Plan mostrado con exito');
    }


    public function vencimiento(Plan $plan, Request $request)
    {
        /** @var Plan $plan */
        switch ($plan->date) {
            case 0:
                $return = Carbon::now()->addDays($plan->cantidad)->startOfDay();
                break;
            case 1:
                $return = Carbon::now()->addDays($plan->cantidad)->startOfDay();
                break;
            case 2:
                $return = Carbon::now()->addWeek()->startOfDay();
                break;
            case 3:
                $return = Carbon::now()->addMonth()->startOfDay();
                break;
            case 4:
                $return = Carbon::now()->addYear()->startOfDay();
                break;
            default:
                $return = Carbon::now()->addDays($plan->cantidad)->startOfDay();
                break;
        }

        return $this->sendResponse($return->format('Y-m-d'), 'Plan mostrado con exito');
    }

    /**
     * Update the specified Plan in storage.
     * PUT/PATCH /plans/{id}
     *
     * @param  int $id
     * @param UpdatePlanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanAPIRequest $request)
    {
        $input = $request->all();

        /** @var Plan $plan */
        $plan = $this->planRepository->findWithoutFail($id);

        if (empty($plan)) {
            return $this->sendError('Plan no encontrado');
        }

        $plan = $this->planRepository->update($input, $id);

        return $this->sendResponse($plan->toArray(), 'Plan actualizado con exito');
    }

    /**
     * Remove the specified Plan from storage.
     * DELETE /plans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Plan $plan */
        $plan = $this->planRepository->findWithoutFail($id);

        if (empty($plan)) {
            return $this->sendError('Plan no encontrado');
        }

        $plan->delete();

        return $this->sendResponse($id, 'Plan borrado con exito');
    }
}
