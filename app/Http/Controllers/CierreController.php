<?php

namespace App\Http\Controllers;

use App\DataTables\CierreDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCierreRequest;
use App\Http\Requests\UpdateCierreRequest;
use App\Repositories\CierreRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CierreController extends AppBaseController
{
    /** @var  CierreRepository */
    private $cierres.epository;

    public function __construct(CierreRepository $cierres.epo)
    {
        $this->cierres.epository = $cierres.epo;
    }

    /**
     * Display a listing of the Cierre.
     *
     * @param CierreDataTable $cierres.ataTable
     * @return Response
     */
    public function index(CierreDataTable $cierres.ataTable)
    {
        return $cierres.ataTable->render('cierres..index');
    }

    /**
     * Show the form for creating a new Cierre.
     *
     * @return Response
     */
    public function create()
    {
        return view('cierres..create');
    }

    /**
     * Store a newly created Cierre in storage.
     *
     * @param CreateCierreRequest $request
     *
     * @return Response
     */
    public function store(CreateCierreRequest $request)
    {
        $input = $request->all();

        $cierres.= $this->cierres.epository->create($input);

        Flash::success('Cierre saved successfully.');

        return redirect(route('cierres..index'));
    }

    /**
     * Display the specified Cierre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cierres.= $this->cierres.epository->findWithoutFail($id);

        if (empty($cierres.) {
            Flash::error('Cierre not found');

            return redirect(route('cierres.index'));
        }

        return view('cierres.show')->with('cierres., $cierres.;
    }

    /**
     * Show the form for editing the specified Cierre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cierres.= $this->cierres.epository->findWithoutFail($id);

        if (empty($cierres.) {
            Flash::error('Cierre not found');

            return redirect(route('cierres.index'));
        }

        return view('cierres.edit')->with('cierres., $cierres.;
    }

    /**
     * Update the specified Cierre in storage.
     *
     * @param  int              $id
     * @param UpdateCierreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCierreRequest $request)
    {
        $cierres.= $this->cierres.epository->findWithoutFail($id);

        if (empty($cierres.) {
            Flash::error('Cierre not found');

            return redirect(route('cierres.index'));
        }

        $cierres.= $this->cierres.epository->update($request->all(), $id);

        Flash::success('Cierre updated successfully.');

        return redirect(route('cierres.index'));
    }

    /**
     * Remove the specified Cierre from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cierres.= $this->cierres.epository->findWithoutFail($id);

        if (empty($cierres.) {
            Flash::error('Cierre not found');

            return redirect(route('cierres.index'));
        }

        $this->cierres.epository->delete($id);

        Flash::success('Cierre deleted successfully.');

        return redirect(route('cierres.index'));
    }
}
