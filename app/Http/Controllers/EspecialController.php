<?php

namespace App\Http\Controllers;

use App\DataTables\EspecialDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateEspecialRequest;
use App\Http\Requests\UpdateEspecialRequest;
use App\Repositories\EspecialRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class EspecialController extends AppBaseController
{
    /** @var  EspecialRepository */
    private $especialRepository;

    public function __construct(EspecialRepository $especialRepo)
    {
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
     * Store a newly created Especial in storage.
     *
     * @param CreateEspecialRequest $request
     *
     * @return Response
     */
    public function store(CreateEspecialRequest $request)
    {
        $input = $request->all();

        $especial = $this->especialRepository->create($input);

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

        return view('especials.edit')->with('especial', $especial);
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
