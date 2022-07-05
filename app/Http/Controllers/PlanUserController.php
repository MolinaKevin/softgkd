<?php

namespace App\Http\Controllers;

use App\DataTables\PlanUserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePlanUserRequest;
use App\Http\Requests\UpdatePlanUserRequest;
use App\Repositories\PlanUserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PlanUserController extends AppBaseController
{
    /** @var  PlanUserRepository */
    private $planUserRepository;

    public function __construct(PlanUserRepository $planUserRepo)
    {
        $this->planUserRepository = $planUserRepo;
    }

    /**
     * Display a listing of the PlanUser.
     *
     * @param PlanUserDataTable $planUserDataTable
     * @return Response
     */
    public function index(PlanUserDataTable $planUserDataTable)
    {
        return $planUserDataTable->render('plan_users.index');
    }

    /**
     * Show the form for creating a new PlanUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('plan_users.create');
    }

    /**
     * Store a newly created PlanUser in storage.
     *
     * @param CreatePlanUserRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanUserRequest $request)
    {
        $input = $request->all();

        $planUser = $this->planUserRepository->create($input);

        Flash::success('Plan User saved successfully.');

        return redirect(route('planUsers.index'));
    }

    /**
     * Display the specified PlanUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $planUser = $this->planUserRepository->findWithoutFail($id);

        if (empty($planUser)) {
            Flash::error('Plan User not found');

            return redirect(route('planUsers.index'));
        }

        return view('plan_users.show')->with('planUser', $planUser);
    }

    /**
     * Show the form for editing the specified PlanUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $planUser = $this->planUserRepository->findWithoutFail($id);

        if (empty($planUser)) {
            Flash::error('Plan User not found');

            return redirect(route('planUsers.index'));
        }

        return view('plan_users.edit')->with('planUser', $planUser);
    }

    /**
     * Update the specified PlanUser in storage.
     *
     * @param  int              $id
     * @param UpdatePlanUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanUserRequest $request)
    {
        $planUser = $this->planUserRepository->findWithoutFail($id);

        if (empty($planUser)) {
            Flash::error('Plan User not found');

            return redirect(route('planUsers.index'));
        }

        $planUser = $this->planUserRepository->update($request->all(), $id);

        Flash::success('Plan User updated successfully.');

        return redirect(route('planUsers.index'));
    }

    /**
     * Remove the specified PlanUser from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $planUser = $this->planUserRepository->findWithoutFail($id);

        if (empty($planUser)) {
            Flash::error('Plan User not found');

            return redirect(route('planUsers.index'));
        }

        $this->planUserRepository->delete($id);

        Flash::success('Plan User deleted successfully.');

        return redirect(route('planUsers.index'));
    }
}
