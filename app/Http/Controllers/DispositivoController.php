<?php

namespace App\Http\Controllers;

use App\DataTables\DispositivoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDispositivoRequest;
use App\Http\Requests\UpdateDispositivoRequest;
use App\Repositories\DispositivoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DispositivoController extends AppBaseController
{
    /** @var  DispositivoRepository */
    private $dispositivoRepository;

    public function __construct(DispositivoRepository $dispositivoRepo)
    {
        $this->dispositivoRepository = $dispositivoRepo;
    }

    /**
     * Display a listing of the Dispositivo.
     *
     * @param DispositivoDataTable $dispositivoDataTable
     * @return Response
     */
    public function index(DispositivoDataTable $dispositivoDataTable)
    {
        return $dispositivoDataTable->render('dispositivos.index');
    }

    /**
     * Show the form for creating a new Dispositivo.
     *
     * @return Response
     */
    public function create()
    {
        return view('dispositivos.create');
    }

    /**
     * Store a newly created Dispositivo in storage.
     *
     * @param CreateDispositivoRequest $request
     *
     * @return Response
     */
    public function store(CreateDispositivoRequest $request)
    {
        $input = $request->all();

        $dispositivo = $this->dispositivoRepository->create($input);

        Flash::success('Dispositivo saved successfully.');

        return redirect(route('dispositivos.index'));
    }

    /**
     * Display the specified Dispositivo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            Flash::error('Dispositivo not found');

            return redirect(route('dispositivos.index'));
        }

        return view('dispositivos.show')->with('dispositivo', $dispositivo);
    }

    /**
     * Show the form for editing the specified Dispositivo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            Flash::error('Dispositivo not found');

            return redirect(route('dispositivos.index'));
        }

        return view('dispositivos.edit')->with('dispositivo', $dispositivo);
    }

    /**
     * Update the specified Dispositivo in storage.
     *
     * @param  int              $id
     * @param UpdateDispositivoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDispositivoRequest $request)
    {
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            Flash::error('Dispositivo not found');

            return redirect(route('dispositivos.index'));
        }

        $dispositivo = $this->dispositivoRepository->update($request->all(), $id);

        Flash::success('Dispositivo updated successfully.');

        return redirect(route('dispositivos.index'));
    }

    /**
     * Remove the specified Dispositivo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            Flash::error('Dispositivo not found');

            return redirect(route('dispositivos.index'));
        }

        $this->dispositivoRepository->delete($id);

        Flash::success('Dispositivo deleted successfully.');

        return redirect(route('dispositivos.index'));
    }
}
