<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDispositivoAPIRequest;
use App\Http\Requests\API\UpdateDispositivoAPIRequest;
use App\Models\Dispositivo;
use App\Models\Especial;
use App\Models\Opcion;
use App\Models\Plan;
use App\Repositories\DispositivoRepository;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Arr;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Laracasts\Flash\Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DispositivoController
 *
 * @package App\Http\Controllers\API
 */
class DispositivoAPIController extends AppBaseController
{
    /** @var  DispositivoRepository */
    private $dispositivoRepository;

    public function __construct(DispositivoRepository $dispositivoRepo)
    {
        $this->dispositivoRepository = $dispositivoRepo;
    }

    /**
     * Display a listing of the Dispositivo.
     * GET|HEAD /dispositivos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->dispositivoRepository->pushCriteria(new RequestCriteria($request));
        $this->dispositivoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $dispositivos = $this->dispositivoRepository->all();

        return $this->sendResponse($dispositivos->toArray(), 'Dispositivos mostrado con exito');
    }

    /**
     * Store a newly created Dispositivo in storage.
     * POST /dispositivos
     *
     * @param CreateDispositivoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDispositivoAPIRequest $request)
    {
        $input = $request->all();

        $dispositivos = $this->dispositivoRepository->create($input);

        return $this->sendResponse($dispositivos->toArray(), 'Dispositivo guardado con exito');
    }

    /**
     * Display the specified Dispositivo.
     * GET|HEAD /dispositivos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Dispositivo $dispositivo */
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            return $this->sendError('Dispositivo no encontrado');
        }

        return $this->sendResponse($dispositivo->toArray(), 'Dispositivo mostrado con exito');
    }

    /**
     * Update the specified Dispositivo in storage.
     * PUT/PATCH /dispositivos/{id}
     *
     * @param  int $id
     * @param UpdateDispositivoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDispositivoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Dispositivo $dispositivo */
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            return $this->sendError('Dispositivo no encontrado');
        }

        $dispositivo = $this->dispositivoRepository->update($input, $id);

        return $this->sendResponse($dispositivo->toArray(), 'Dispositivo actualizado con exito');
    }

    /**
     * Remove the specified Dispositivo from storage.
     * DELETE /dispositivos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Dispositivo $dispositivo */
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            return $this->sendError('Dispositivo no encontrado');
        }

        $dispositivo->delete();

        return $this->sendResponse($id, 'Dispositivo borrado con exito');
    }

    public function addPlan($id, Request $request)
    {
        $input = $request->all();

        $dispositivo = Dispositivo::find($id);

        $plan = Plan::find($input['plan']);

        $dispositivo->plans()->save($plan);

        return $this->sendResponse($dispositivo->toArray(), 'Plan agregado con exito');
    }

    public function addEspecial($id, Request $request)
    {
        $input = $request->all();

        $dispositivo = Dispositivo::find($id);

        $plan = Especial::find($input['plan']);

        $dispositivo->especials()->save($plan);

        return $this->sendResponse($dispositivo->toArray(), 'Plan agregado con exito');
    }

    public function plans($id)
    {
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            Flash::error('Dispositivo no encontrado');

            return redirect(route('users.index'));
        }

        return response()->json($dispositivo->plans()->get());

    }

    public function ingresables($id)
    {
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        if (empty($dispositivo)) {
            Flash::error('Dispositivo no encontrado');

            return redirect(route('users.index'));
        }

        return response()->json(Dispositivo::where('id',$dispositivo->id)->with('plans','especials')->get());

    }

    public function ingresados(Dispositivo $dispositivo, Request $request)
    {
        if (empty($dispositivo)) {
            Flash::error('Dispositivo no encontrado');

            return redirect(route('users.index'));
        }

        $dispositivo->ingresados = $request->input('ingresados');
        $dispositivo->save();

        return response($request->input('ingresados'));

        return $request->input('ingresados');

    }

    public function moduloPersonalizado($id)
    {
        $dispositivo = $this->dispositivoRepository->findWithoutFail($id);

        $opcion = Opcion::where('clave','correctos')->get();
        $opcion = $opcion[0];

        if ($opcion->valor == 1) {
            $users2 = User::where('supraestado','=',0)->get();
            $users = [];
            foreach ($users2 as $user) {
                $res = new \stdClass();
                $res->nombre = $user->name;
                $res->credencial = $user->id;
                $res->huellas = $user->huellas;
                if ($user->hasTag()) {
                    $res->tag = $user->tag->codigo;
                } else {
                    $res->tag = "";
                }
                $res->supraestado = $user->supraestado;
                $users[] = $res;
            }
        } else {
            $plans = $dispositivo->plans;
            $plans = $plans->concat($dispositivo->especials);

            $users = [];
            foreach ($plans as $ingresable) {
                foreach ($ingresable->users->unique() as $user) {
                    if (($user->estado ==  "Correcto" || $user->estado ==  "Sin Huella") && ! $user->isRole('admin')) {
                        $res = new \stdClass();
                        $res->nombre = $user->name;
                        $res->credencial = $user->id;
                        $res->huellas = $user->huellas;
                        if ($user->hasTag()) {
                            $res->tag = $user->tag->codigo;
                        } else {
                            $res->tag = "";
                        }
                        $res->supraestado = $user->supraestado;
                        $users[] = $res;
                    }
                }
            }
        }

        $accesoConcedido = User::where('supraestado','=',1)->get();

        foreach ($accesoConcedido->unique() as $user) {
            $res = new \stdClass();
            $res->nombre = $user->name;
            $res->credencial = $user->id;
            $res->huellas = $user->huellas;
            if ($user->hasTag()) {
                $res->tag = $user->tag->codigo;
            } else {
                $res->tag = "";
            }
            $res->supraestado = $user->supraestado;
            $users[] = $res;
        }


        $filtered = Arr::where($users,function ($value,$key) {
            return  $value->supraestado == 2;
        });

        $usersDenegados = [];

        foreach ($filtered as $user) {
            if (($key = array_search($user, $users)) !== false) {
                unset($users[$key]);
            }
        }

        $users = array_values($users);

        return $users;
    }
}
