<?php

namespace App\Http\Controllers;

use App\DataTables\ArqueoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateArqueoRequest;
use App\Http\Requests\UpdateArqueoRequest;
use App\Models\Arqueo;
use App\Models\Movimiento;
use App\Models\Pago;
use App\Repositories\ArqueoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ArqueoController extends AppBaseController
{
    /** @var  ArqueoRepository */
    private $arqueoRepository;

    public function __construct(ArqueoRepository $arqueoRepo)
    {
        $this->arqueoRepository = $arqueoRepo;
    }

    /**
     * Display a listing of the Arqueo.
     *
     * @param ArqueoDataTable $arqueoDataTable
     * @return Response
     */
    public function index(ArqueoDataTable $arqueoDataTable)
    {
        return $arqueoDataTable->render('arqueos.index');
    }

    /**
     * Show the form for creating a new Arqueo.
     *
     * @return Response
     */
    public function create()
    {
        $arqueo = Arqueo::orderBy('created_at','desc')->first();
        if (!$arqueo) {
            $arqueo = new \stdClass();
            $arqueo->created_at = '1999-01-01 00:00:01';
        }
        $movimientos = Movimiento::where('created_at', '>=', $arqueo->created_at)->get();
        $pagos = Pago::where('created_at', '>', $arqueo->created_at)->get();
        $total = 0;
        foreach ($movimientos as $movimiento) {
            $total += $movimiento->precio;
        }
        foreach ($pagos as $pago) {
            $total += $pago->precio;
        }
        return view('arqueos.create', compact('total'));
    }

    /**
     * Store a newly created Arqueo in storage.
     *
     * @param CreateArqueoRequest $request
     *
     * @return Response
     */
    public function store(CreateArqueoRequest $request)
    {
        $input = $request->all();

        $arqueo = $this->arqueoRepository->create($input);

        Flash::success('Arqueo saved successfully.');

        return redirect(route('arqueos.index'));
    }

    /**
     * Display the specified Arqueo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $arqueo = $this->arqueoRepository->findWithoutFail($id);

        if (empty($arqueo)) {
            Flash::error('Arqueo not found');

            return redirect(route('arqueos.index'));
        }

        return view('arqueos.show')->with('arqueo', $arqueo);
    }

    /**
     * Show the form for editing the specified Arqueo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $arqueo = $this->arqueoRepository->findWithoutFail($id);

        if (empty($arqueo)) {
            Flash::error('Arqueo not found');

            return redirect(route('arqueos.index'));
        }

        return view('arqueos.edit')->with('arqueo', $arqueo);
    }

    /**
     * Update the specified Arqueo in storage.
     *
     * @param  int              $id
     * @param UpdateArqueoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArqueoRequest $request)
    {
        $arqueo = $this->arqueoRepository->findWithoutFail($id);

        if (empty($arqueo)) {
            Flash::error('Arqueo not found');

            return redirect(route('arqueos.index'));
        }

        $arqueo = $this->arqueoRepository->update($request->all(), $id);

        Flash::success('Arqueo updated successfully.');

        return redirect(route('arqueos.index'));
    }

    /**
     * Remove the specified Arqueo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $arqueo = $this->arqueoRepository->findWithoutFail($id);

        if (empty($arqueo)) {
            Flash::error('Arqueo not found');

            return redirect(route('arqueos.index'));
        }

        $this->arqueoRepository->delete($id);

        Flash::success('Arqueo deleted successfully.');

        return redirect(route('arqueos.index'));
    }
}
