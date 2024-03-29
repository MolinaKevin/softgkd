<?php

namespace App\Http\Controllers;

use App\DataTables\EspecialDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateEspecialRequest;
use App\Http\Requests\UpdateEspecialRequest;
use App\Models\EspecialUser;
use App\Models\User;
use App\Repositories\EspecialRepository;
use Carbon\Carbon;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class EspecialController extends AppBaseController
{
    /** @var  EspecialRepository */
    private $especialRepository;

    public function __construct(EspecialRepository $especialRepo)
    {
        $this->middleware('permission:especials.index')->only('index');
        $this->middleware('permission:especials.create')->only(['create','store']);
        $this->middleware('permission:especials.edit')->only(['edit','update']);
        $this->middleware('permission:especials.show')->only('show');
        $this->middleware('permission:especials.destroy')->only('destroy');
        $this->especialRepository = $especialRepo;
    }

    /**
     * Display a listing of the Especial.
     *
     * @param EspecialDataTable $especialDataTable
     * @return Response
     */
    public function index(EspecialDataTable $especialDataTable)
    {
        return $especialDataTable->render('especials.index');
    }

    /**
     * Show the form for creating a new Especial.
     *
     * @return Response
     */
    public function create()
    {
        $horarios = \App\Models\Horario::all();
        $horarios->each(function ($model) { $model->setAppends(['name']); });
        return view('especials.create',compact('horarios'));
    }

    /**
     * Show the form for creating a new Especial.
     *
     * @return Response
     */

    public function createUser(User $user)
    {
        $horarios = \App\Models\Horario::orderBy('dia','asc')->get();
        $horarios->each(function ($model) { $model->setAppends(['name']); });
        return view('especials.create',compact('horarios','user'));
    }

    /**
     * Store a newly created Especial in storage.
     *
     * @param CreateEspecialRequest $request
     *
     * @return Response
     */
    public function store(CreateEspecialRequest $request)
    {
        $input = $request->all();

        if (!isset($input['date'])) {
            $input['date'] = 0;
        }

        $user = User::find($input['user']);

        $especial = $this->especialRepository->create($input);

        $user->especials()->save($especial);

        $planEsp = $user->especials->find($especial->id);

        $pivot = EspecialUser::find($planEsp->pivot->id);

        if ($input['date'] == 0) {
            $pivot->vencimiento = Carbon::now()->addDays($input['cantidad'])->startOfDay();
        }

        $pivot->adeudar();

        Flash::success('Especial saved successfully.');

        return redirect(route('especials.index'));
    }

    /**
     * Display the specified Especial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $especial = $this->especialRepository->findWithoutFail($id);

        if (empty($especial)) {
            Flash::error('Especial not found');

            return redirect(route('especials.index'));
        }

        return view('especials.show')->with('especial', $especial);
    }

    /**
     * Show the form for editing the specified Especial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $especial = $this->especialRepository->findWithoutFail($id);

        if (empty($especial)) {
            Flash::error('Especial not found');

            return redirect(route('especials.index'));
        }

        $user = $especial->first_user;


        $horarios = \App\Models\Horario::orderBy('dia','asc')->get();
        $horarios->each(function ($model) { $model->setAppends(['name']); });
        return view('especials.edit',compact('user','horarios'))->with('especial', $especial);
    }

    /**
     * Update the specified Especial in storage.
     *
     * @param  int              $id
     * @param UpdateEspecialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEspecialRequest $request)
    {
        $especial = $this->especialRepository->findWithoutFail($id);

        if (empty($especial)) {
            Flash::error('Especial not found');

            return redirect(route('especials.index'));
        }

        $especial = $this->especialRepository->update($request->all(), $id);

        Flash::success('Especial updated successfully.');

        return redirect(route('especials.index'));
    }

    /**
     * Remove the specified Especial from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $especial = $this->especialRepository->findWithoutFail($id);

        if (empty($especial)) {
            Flash::error('Especial not found');

            return redirect(route('especials.index'));
        }

        $this->especialRepository->delete($id);

        Flash::success('Especial deleted successfully.');

        return redirect(route('especials.index'));
    }
}
