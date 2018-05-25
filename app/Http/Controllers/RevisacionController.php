<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRevisacionRequest;
use App\Http\Requests\UpdateRevisacionRequest;
use App\Repositories\RevisacionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class RevisacionController extends AppBaseController
{
    /** @var  RevisacionRepository */
    private $revisacionRepository;

    public function __construct(RevisacionRepository $revisacionRepo)
    {
        $this->revisacionRepository = $revisacionRepo;
    }

    /**
     * Display a listing of the Revisacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->revisacionRepository->pushCriteria(new RequestCriteria($request));
        $revisacions = $this->revisacionRepository->all();

        return view('revisacions.index')->with('revisacions', $revisacions);
    }

    /**
     * Show the form for creating a new Revisacion.
     *
     * @return Response
     */
    public function create()
    {

        $users = \App\Models\User::all();
        $users->each(function ($model) { $model->setAppends(['name']); });
        return view('revisacions.create', compact('users'));
    }

    /**
     * Store a newly created Revisacion in storage.
     *
     * @param CreateRevisacionRequest $request
     *
     * @return Response
     */
    public function store(CreateRevisacionRequest $request)
    {
        $input = $request->all();

        $revisacion = $this->revisacionRepository->create($input);

        Flash::success('Revisacion saved successfully.');

        return redirect(route('revisacions.index'));
    }

    /**
     * Display the specified Revisacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $revisacion = $this->revisacionRepository->findWithoutFail($id);

        if (empty($revisacion)) {
            Flash::error('Revisacion not found');

            return redirect(route('revisacions.index'));
        }

        return view('revisacions.show')->with('revisacion', $revisacion);
    }

    /**
     * Show the form for editing the specified Revisacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $revisacion = $this->revisacionRepository->findWithoutFail($id);

        if (empty($revisacion)) {
            Flash::error('Revisacion not found');

            return redirect(route('revisacions.index'));
        }

        return view('revisacions.edit')->with('revisacion', $revisacion);
    }

    /**
     * Update the specified Revisacion in storage.
     *
     * @param  int $id
     * @param UpdateRevisacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRevisacionRequest $request)
    {
        $revisacion = $this->revisacionRepository->findWithoutFail($id);

        if (empty($revisacion)) {
            Flash::error('Revisacion not found');

            return redirect(route('revisacions.index'));
        }

        $revisacion = $this->revisacionRepository->update($request->all(), $id);

        Flash::success('Revisacion updated successfully.');

        return redirect(route('revisacions.index'));
    }

    /**
     * Remove the specified Revisacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $revisacion = $this->revisacionRepository->findWithoutFail($id);

        if (empty($revisacion)) {
            Flash::error('Revisacion not found');

            return redirect(route('revisacions.index'));
        }

        $this->revisacionRepository->delete($id);

        Flash::success('Revisacion deleted successfully.');

        return redirect(route('revisacions.index'));
    }
}
