<?php

namespace App\Http\Controllers;

use App\DataTables\ConexionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateConexionRequest;
use App\Http\Requests\UpdateConexionRequest;
use App\Repositories\ConexionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ConexionController extends AppBaseController
{
    /** @var  ConexionRepository */
    private $conexionRepository;

    public function __construct(ConexionRepository $conexionRepo)
    {
        $this->conexionRepository = $conexionRepo;
    }

    /**
     * Display a listing of the Conexion.
     *
     * @param ConexionDataTable $conexionDataTable
     * @return Response
     */
    public function index(ConexionDataTable $conexionDataTable)
    {
        return $conexionDataTable->render('conexions.index');
    }

    /**
     * Show the form for creating a new Conexion.
     *
     * @return Response
     */
    public function create()
    {
        return view('conexions.create');
    }

    /**
     * Store a newly created Conexion in storage.
     *
     * @param CreateConexionRequest $request
     *
     * @return Response
     */
    public function store(CreateConexionRequest $request)
    {
        $input = $request->all();

        $conexion = $this->conexionRepository->create($input);

        Flash::success('Conexion saved successfully.');

        return redirect(route('conexions.index'));
    }

    /**
     * Display the specified Conexion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $conexion = $this->conexionRepository->findWithoutFail($id);

        if (empty($conexion)) {
            Flash::error('Conexion not found');

            return redirect(route('conexions.index'));
        }

        return view('conexions.show')->with('conexion', $conexion);
    }

    /**
     * Show the form for editing the specified Conexion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $conexion = $this->conexionRepository->findWithoutFail($id);

        if (empty($conexion)) {
            Flash::error('Conexion not found');

            return redirect(route('conexions.index'));
        }

        return view('conexions.edit')->with('conexion', $conexion);
    }

    /**
     * Update the specified Conexion in storage.
     *
     * @param  int              $id
     * @param UpdateConexionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConexionRequest $request)
    {
        $conexion = $this->conexionRepository->findWithoutFail($id);

        if (empty($conexion)) {
            Flash::error('Conexion not found');

            return redirect(route('conexions.index'));
        }

        $conexion = $this->conexionRepository->update($request->all(), $id);

        Flash::success('Conexion updated successfully.');

        return redirect(route('conexions.index'));
    }

    /**
     * Remove the specified Conexion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $conexion = $this->conexionRepository->findWithoutFail($id);

        if (empty($conexion)) {
            Flash::error('Conexion not found');

            return redirect(route('conexions.index'));
        }

        $this->conexionRepository->delete($id);

        Flash::success('Conexion deleted successfully.');

        return redirect(route('conexions.index'));
    }
}
