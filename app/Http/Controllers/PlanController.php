<?php

namespace App\Http\Controllers;

use App\DataTables\PlanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Repositories\PlanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PlanController extends AppBaseController
{
    /** @var  PlanRepository */
    private $planRepository;

    public function __construct(PlanRepository $planRepo)
    {
        $this->middleware('permission:plans.index')->only('index');
        $this->middleware('permission:plans.create')->only(['create','store']);
        $this->middleware('permission:plans.edit')->only(['edit','update']);
        $this->middleware('permission:plans.show')->only('show');
        $this->middleware('permission:plans.destroy')->only('destroy');
        $this->planRepository = $planRepo;
    }

    /**
     * Display a listing of the Plan.
     *
     * @param PlanDataTable $planDataTable
     * @return Response
     */
    public function index(PlanDataTable $planDataTable)
    {
        return $planDataTable->render('plans.index');
    }

    /**
     * Show the form for creating a new Plan.
     *
     * @return Response
     */
    public function create()
    {
        $horarios = \App\Models\Horario::orderBy('dia','asc')->get();
        $horarios->each(function ($model) { $model->setAppends(['name']); });
        return view('plans.create', compact('horarios'));
    }

    /**
     * Store a newly created Plan in storage.
     *
     * @param CreatePlanRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanRequest $request)
    {
        $input = $request->all();

        if (!isset($input['date'])) {
            $input['date'] = 0;
        }

        $plan = $this->planRepository->create($input);

        Flash::success('Plan saved successfully.');

        return redirect(route('plans.index'));
    }

    /**
     * Display the specified Plan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $plan = $this->planRepository->findWithoutFail($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        return view('plans.show')->with('plan', $plan);
    }

    /**
     * Show the form for editing the specified Plan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $plan = $this->planRepository->findWithoutFail($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        $horarios = \App\Models\Horario::orderBy('dia','asc')->get();g
        $horarios->each(function ($model) { $model->setAppends(['name']); });
        return view('plans.edit', compact('horarios'))->with('plan', $plan);
    }

    /**
     * Update the specified Plan in storage.
     *
     * @param  int              $id
     * @param UpdatePlanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanRequest $request)
    {
        $plan = $this->planRepository->findWithoutFail($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        $plan = $this->planRepository->update($request->all(), $id);

        Flash::success('Plan updated successfully.');

        return redirect(route('plans.index'));
    }

    /**
     * Remove the specified Plan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $plan = $this->planRepository->findWithoutFail($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        $this->planRepository->delete($id);

        Flash::success('Plan deleted successfully.');

        return redirect(route('plans.index'));
    }
}
