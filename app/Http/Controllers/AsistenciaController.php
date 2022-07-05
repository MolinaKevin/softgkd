<?php
namespace App\Http\Controllers;
use App\DataTables\AsistenciaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAsistenciaRequest;
use App\Http\Requests\UpdateAsistenciaRequest;
use App\Repositories\AsistenciaRepository;
use App\Models\User;
use Carbon\Carbon;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
class AsistenciaController extends AppBaseController
{
    /** @var  AsistenciaRepository */
    private $asistenciaRepository;
    public function __construct(AsistenciaRepository $asistenciaRepo)
    {
        $this->middleware('permission:asistencias.index')->only('index');
        $this->middleware('permission:asistencias.create')->only(['create','store']);
        $this->middleware('permission:asistencias.edit')->only(['edit','update']);
        $this->middleware('permission:asistencias.show')->only('show');
        $this->middleware('permission:asistencias.destroy')->only('destroy');
        $this->asistenciaRepository = $asistenciaRepo;
    }
    /**
     * Display a listing of the Asistencia.
     *
     * @param AsistenciaDataTable $asistenciaDataTable
     * @return Response
     */
    public function index(AsistenciaDataTable $asistenciaDataTable)
    {
        $users = User::all();
        return $asistenciaDataTable->render('asistencias.index', compact('users'));
    }
    /**
     * Show the form for creating a new Asistencia.
     *
     * @return Response
     */
    public function create()
    {
        return view('asistencias.create');
    }
    /**
     * Store a newly created Asistencia in storage.
     *
     * @param CreateAsistenciaRequest $request
     *
     * @return Response
     */
    public function store(CreateAsistenciaRequest $request)
    {
        $input = $request->all();
        $input['horario'] = Carbon::parse($input['horario']);
        $asistencias = $this->asistenciaRepository->create($input);
        Flash::success('Asistencia saved successfully.');
        return redirect(route('asistencias.index'));
    }
    /**
     * Display the specified Asistencia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $asistencia = $this->asistenciaRepository->findWithoutFail($id);
        if (empty($asistencia)) {
            Flash::error('Asistencia not found');
            return redirect(route('asistencias.index'));
        }
        return view('asistencias.show')->with('asistencia', $asistencia);
    }
    /**
     * Show the form for editing the specified Asistencia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $asistencia = $this->asistenciaRepository->findWithoutFail($id);
        if (empty($asistencia)) {
            Flash::error('Asistencia not found');
            return redirect(route('asistencias.index'));
        }
        return view('asistencias.edit')->with('asistencia', $asistencia);
    }
    /**
     * Update the specified Asistencia in storage.
     *
     * @param  int              $id
     * @param UpdateAsistenciaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAsistenciaRequest $request)
    {
        $asistencia = $this->asistenciaRepository->findWithoutFail($id);
        if (empty($asistencia)) {
            Flash::error('Asistencia not found');
            return redirect(route('asistencias.index'));
        }
        $asistencia = $this->asistenciaRepository->update($request->all(), $id);
        Flash::success('Asistencia updated successfully.');
        return redirect(route('asistencias.index'));
    }
    /**
     * Remove the specified Asistencia from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $asistencia = $this->asistenciaRepository->findWithoutFail($id);
        if (empty($asistencia)) {
            Flash::error('Asistencia not found');
            return redirect(route('asistencias.index'));
        }
        $this->asistenciaRepository->delete($id);
        Flash::success('Asistencia deleted successfully.');
        return redirect(route('asistencias.index'));
    }
}