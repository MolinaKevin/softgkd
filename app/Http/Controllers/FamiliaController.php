<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFamiliaRequest;
use App\Http\Requests\UpdateFamiliaRequest;
use App\Repositories\FamiliaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FamiliaController extends AppBaseController
{
    /** @var  FamiliaRepository */
    private $familiaRepository;

    public function __construct(FamiliaRepository $familiaRepo)
    {
        $this->middleware('permission:familias.index')->only('index');
        $this->middleware('permission:familias.create')->only(['create','store']);
        $this->middleware('permission:familias.edit')->only(['edit','update']);
        $this->middleware('permission:familias.show')->only('show');
        $this->middleware('permission:familias.destroy')->only('destroy');
        $this->familiaRepository = $familiaRepo;
    }

    /**
     * Display a listing of the Familia.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->q) {
            $familias = $this->familiaRepository->orderBy('name','asc')->findLike($request->q);
        } else {
            $this->familiaRepository->pushCriteria(new RequestCriteria($request));
            $familias = $this->familiaRepository->orderBy('name','asc')->all();
        }

        return view('familias.index')->with('familias', $familias);
    }

    /**
     * Show the form for creating a new Familia.
     *
     * @return Response
     */
    public function create()
    {
        return view('familias.create');
    }

    /**
     * Store a newly created Familia in storage.
     *
     * @param CreateFamiliaRequest $request
     *
     * @return Response
     */
    public function store(CreateFamiliaRequest $request)
    {
        $input = $request->all();

        $familia = $this->familiaRepository->create($input);

        Flash::success('Familia saved successfully.');

        return redirect(route('familias.index'));
    }

    /**
     * Display the specified Familia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $familia = $this->familiaRepository->findWithoutFail($id);

        if (empty($familia)) {
            Flash::error('Familia not found');

            return redirect(route('familias.index'));
        }

        return view('familias.show')->with('familia', $familia);
    }

    /**
     * Show the form for editing the specified Familia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $familia = $this->familiaRepository->findWithoutFail($id);

        if (empty($familia)) {
            Flash::error('Familia not found');

            return redirect(route('familias.index'));
        }

        return view('familias.edit')->with('familia', $familia);
    }

    /**
     * Update the specified Familia in storage.
     *
     * @param  int $id
     * @param UpdateFamiliaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFamiliaRequest $request)
    {
        $familia = $this->familiaRepository->findWithoutFail($id);

        if (empty($familia)) {
            Flash::error('Familia not found');

            return redirect(route('familias.index'));
        }

        $familia = $this->familiaRepository->update($request->all(), $id);

        Flash::success('Familia updated successfully.');

        return redirect(route('familias.index'));
    }

    /**
     * Remove the specified Familia from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $familia = $this->familiaRepository->findWithoutFail($id);

        if (empty($familia)) {
            Flash::error('Familia not found');

            return redirect(route('familias.index'));
        }

        $this->familiaRepository->delete($id);

        Flash::success('Familia deleted successfully.');

        return redirect(route('familias.index'));
    }

    /**
     * Show all User from one Familia
     *
     * @param  int $id
     *
     * @return Response
     */

    public function usuarios($id)
    {
        $familia = $this->familiaRepository->findWithoutFail($id);

        if (empty($familia)) {
            Flash::error('Familia no encontrada');

            return redirect(route('familias.index'));
        }

        return view('familias.users')->with('users', $familia->users)->with('familia', $familia);
    }

    /**
     * Show all Deudas from one Familia
     *
     * @param  int $id
     *
     * @return Response
     */

    public function deudas($id)
    {
        $familia = $this->familiaRepository->findWithoutFail($id);

        if (empty($familia)) {
            Flash::error('Familia no encontrada');

            return redirect(route('familias.index'));
        }

        return view('familias.deudas')->with('deudas', $familia->deudas)->with('familia', $familia);
    }

    /**
     * Show all Pagos from one Familia
     *
     * @param  int $id
     *
     * @return Response
     */

    public function pagos($id)
    {
        $familia = $this->familiaRepository->findWithoutFail($id);

        if (empty($familia)) {
            Flash::error('Familia no encontrada');

            return redirect(route('familias.index'));
        }

        return view('familias.pagos')->with('pagos', $familia->pagos)->with('familia', $familia);
    }

    /**
     * Busqeuda ajax
     *
     * @param  Request $request
     *
     * @return string
     */

    public function busqueda(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $familias = $this->familiaRepository->orderBy('name', 'asc')->findLike($request->q);
            if ($familias) {
                foreach ($familias as $key => $familia) {
                    $output .= "<tr data-id=\"$familia->id\">"
                        . "<td>$familia->name</td>"
                        . '<div class="btn-group">'
                        . "<a href=\"" . route('familia.users', [$familia->id]) . "\" class='btn btn-default btn-xs'><i class=\"glyphicon glyphicon-list-alt\"></i></a>"
                        . '<a href="' . route('familia.deudas', [$familia->id]) . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-list-alt"></i></a>'
                        . '<a href="' . route('familia.pagos', [$familia->id]) . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-usd"></i></a>'
                        . '<a href="' . route('familias.show', [$familia->id]). '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '<a href="' . route('familias.edit', [$familia->id]) . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>'
                        . '<a href="#" class="btn btn-danger btn-xs" onclick="return alert(\'La funcion de borrar está desactivada en el buscado rapido\')" disabled="disabled"><i class="glyphicon glyphicon-trash"></i></a>'
                        . '</div>'
                        . '</td>'
                        . '</tr>';
                }
                return $output;
            }
        }
    }
}
