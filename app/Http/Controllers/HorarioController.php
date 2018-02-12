<?php

namespace App\Http\Controllers;

use App\DataTables\HorarioDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateHorarioRequest;
use App\Http\Requests\UpdateHorarioRequest;
use App\Repositories\HorarioRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class HorarioController extends AppBaseController
{
    /** @var  HorarioRepository */
    private $horarioRepository;

    public function __construct(HorarioRepository $horarioRepo)
    {
        $this->horarioRepository = $horarioRepo;
    }

    /**
     * Display a listing of the Horario.
     *
     * @param HorarioDataTable $horarioDataTable
     * @return Response
     */
    public function index(HorarioDataTable $horarioDataTable)
    {
        return $horarioDataTable->render('horarios.index');
    }

    /**
     * Show the form for creating a new Horario.
     *
     * @return Response
     */
    public function create()
    {
        return view('horarios.create');
    }

    /**
     * Store a newly created Horario in storage.
     *
     * @param CreateHorarioRequest $request
     *
     * @return Response
     */
    public function store(CreateHorarioRequest $request)
    {
        $input = $request->all();

        $horario = $this->horarioRepository->create($input);

        Flash::success('Horario saved successfully.');

        return redirect(route('horarios.index'));
    }

    /**
     * Display the specified Horario.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $horario = $this->horarioRepository->findWithoutFail($id);

        if (empty($horario)) {
            Flash::error('Horario not found');

            return redirect(route('horarios.index'));
        }

        return view('horarios.show')->with('horario', $horario);
    }

    /**
     * Show the form for editing the specified Horario.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $horario = $this->horarioRepository->findWithoutFail($id);

        if (empty($horario)) {
            Flash::error('Horario not found');

            return redirect(route('horarios.index'));
        }

        return view('horarios.edit')->with('horario', $horario);
    }

    /**
     * Update the specified Horario in storage.
     *
     * @param  int              $id
     * @param UpdateHorarioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHorarioRequest $request)
    {
        $horario = $this->horarioRepository->findWithoutFail($id);

        if (empty($horario)) {
            Flash::error('Horario not found');

            return redirect(route('horarios.index'));
        }

        $horario = $this->horarioRepository->update($request->all(), $id);

        Flash::success('Horario updated successfully.');

        return redirect(route('horarios.index'));
    }

    /**
     * Remove the specified Horario from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $horario = $this->horarioRepository->findWithoutFail($id);

        if (empty($horario)) {
            Flash::error('Horario not found');

            return redirect(route('horarios.index'));
        }

        $this->horarioRepository->delete($id);

        Flash::success('Horario deleted successfully.');

        return redirect(route('horarios.index'));
    }
}
