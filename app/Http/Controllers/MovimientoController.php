<?php

namespace App\Http\Controllers;

use App\DataTables\MovimientoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMovimientoRequest;
use App\Http\Requests\UpdateMovimientoRequest;
use App\Repositories\MovimientoRepository;
use App\Models\User;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MovimientoController extends AppBaseController
{
    /** @var  MovimientoRepository */
    private $movimientoRepository;

    public function __construct(MovimientoRepository $movimientoRepo)
    {
        $this->movimientoRepository = $movimientoRepo;
    }

    /**
     * Display a listing of the Movimiento.
     *
     * @param MovimientoDataTable $movimientoDataTable
     * @return Response
     */
    public function index(MovimientoDataTable $movimientoDataTable)
    {
        return $movimientoDataTable->render('movimientos.index');
    }

    /**
     * Show the form for creating a new Movimiento.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::orderBy('first_name','asc')->get();
        $users->each(function ($model) { $model->setAppends(['name']); });
        return view('movimientos.create', compact('users'));
    }

    /**
     * Store a newly created Movimiento in storage.
     *
     * @param CreateMovimientoRequest $request
     *
     * @return Response
     */
    public function store(CreateMovimientoRequest $request)
    {
        $input = $request->all();

        $movimiento = $this->movimientoRepository->create($input);

        $movimiento->adeudable_type = User::class;
        $movimiento->adeudable_id = $input['user'];

        $movimiento->update();

        Flash::success('Movimiento saved successfully.');

        return redirect(route('movimientos.index'));
    }

    /**
     * Display the specified Movimiento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $movimiento = $this->movimientoRepository->findWithoutFail($id);

        if (empty($movimiento)) {
            Flash::error('Movimiento not found');

            return redirect(route('movimientos.index'));
        }

        return view('movimientos.show')->with('movimiento', $movimiento);
    }

    /**
     * Show the form for editing the specified Movimiento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $movimiento = $this->movimientoRepository->findWithoutFail($id);

        if (empty($movimiento)) {
            Flash::error('Movimiento not found');

            return redirect(route('movimientos.index'));
        }

        return view('movimientos.edit')->with('movimiento', $movimiento);
    }

    /**
     * Update the specified Movimiento in storage.
     *
     * @param  int              $id
     * @param UpdateMovimientoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMovimientoRequest $request)
    {
        $movimiento = $this->movimientoRepository->findWithoutFail($id);

        if (empty($movimiento)) {
            Flash::error('Movimiento not found');

            return redirect(route('movimientos.index'));
        }

        $movimiento = $this->movimientoRepository->update($request->all(), $id);

        Flash::success('Movimiento updated successfully.');

        return redirect(route('movimientos.index'));
    }

    /**
     * Remove the specified Movimiento from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $movimiento = $this->movimientoRepository->findWithoutFail($id);

        if (empty($movimiento)) {
            Flash::error('Movimiento not found');

            return redirect(route('movimientos.index'));
        }

        $this->movimientoRepository->delete($id);

        Flash::success('Movimiento deleted successfully.');

        return redirect(route('movimientos.index'));
    }
}
