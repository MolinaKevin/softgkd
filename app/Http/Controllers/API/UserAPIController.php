<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Models\Deuda;
use App\Models\Dispositivo;
use App\Models\Huella;
use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\UserRepository;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Carbon;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DebugBar;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\API
 */
class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     * GET|HEAD /users
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $this->userRepository->pushCriteria(new LimitOffsetCriteria($request));
        $users = $this->userRepository->all();

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }

    /**
     * Store a newly created User in storage.
     * POST /users
     *
     * @param CreateUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->all();

        $users = $this->userRepository->create($input);

        return $this->sendResponse($users->toArray(), 'User saved successfully');
    }

    /**
     * Display the specified User.
     * GET|HEAD /users/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}
     *
     * @param  int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $planes = $user->plans;

        $user = $this->userRepository->update($input, $id);

        foreach($planes as $plan) {
            $user->plans()->save($plan);
            switch ($plan->date) {
                case 0:
                    $user->plans()->updateExistingPivot($plan->id, ['clases' => $plan->cantidad + $input['adicion']]);
                    break;
                case 1:
                    if(empty($request->date)){
                        $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addDays($plan->cantidad + $input['adicion'])->endOfDay()]);
                    } else {
                        $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::createFromFormat('Y-m-d', $input['date'])->endOfDay()]);
                    }
                    break;
                case 2:
                    if(empty($request->date)){
                        $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addWeek()]);
                    } else {
                        $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::createFromFormat('Y-m-d', $input['date'])->endOfDay()]);
                    }
                    break;
                case 3:
                    if(empty($request->date)){
                        $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addMonth()]);
                    } else {
                        $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::createFromFormat('Y-m-d', $input['date'])->endOfDay()]);
                    }
                    break;
                case 4:
                    if(empty($request->date)){
                        $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addYear()]);
                    } else {
                        $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::createFromFormat('Y-m-d', $input['date'])->endOfDay()]);
                    }
                    break;
                default:
                    $user->plans()->updateExistingPivot($plan->id, ['clases' => $plan->cantidad + $input['adicion']]);
                    break;
            }
        }

        $plan = Plan::find($input['plans'][0]);

       // switch ($plan->date) {
       //     case 0:
       //         $user->plans()->updateExistingPivot($plan->id, ['clases' => $plan->cantidad + $input['adicion']]);
       //         break;
       //     case 1:
       //         if(empty($request->date)){
       //             $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addDays($plan->cantidad + $input['adicion'])->endOfDay()]);
       //         } else {
       //             $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::createFromFormat('Y-m-d', $input['date'])->endOfDay()]);
       //         }
       //         break;
       //     case 2:
       //         if(empty($request->date)){
       //             $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addWeek()]);
       //         } else {
       //             $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::createFromFormat('Y-m-d', $input['date'])->endOfDay()]);
       //         }
       //         break;
       //     case 3:
       //         if(empty($request->date)){
       //             $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addMonth()]);
       //         } else {
       //             $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::createFromFormat('Y-m-d', $input['date'])->endOfDay()]);
       //         }
       //         break;
       //     case 4:
       //         if(empty($request->date)){
       //             $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addYear()]);
       //         } else {
       //             $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::createFromFormat('Y-m-d', $input['date'])->endOfDay()]);
       //         }
       //         break;
       //     default:
       //         $user->plans()->updateExistingPivot($plan->id, ['clases' => $plan->cantidad + $input['adicion']]);
       //         break;
       // }
        if(empty($request->date)) {
            $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()]);
        } else {
            $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::createFromFormat('Y-m-d', $input['date'])->endOfDay()]);
        }
        $user->save();

        $plan = $user->plans->find($input['plans'][0]);

        $pivot = PlanUser::find($plan->pivot->id);

        $pivot->pagado = 0;
        $pivot->save();

        //$pivot->adeudar();

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }

    /**
     * Remove the specified User from storage.
     * DELETE /users/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user->delete();

        return $this->sendResponse($id, 'User deleted successfully');
    }

    /**
     * Update the specified User in storage with plan.
     * PUT/PATCH /users/{id}/plan
     *
     * @param  int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function addPlan($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user = $this->userRepository->update($input, $id);

        return $this->sendResponse($user->toArray(), 'Usuario editado con exito');
    }

    /**
     * Update the specified User in storage with plan.
     * PUT/PATCH /users/{id}/plan
     *
     * @param  int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function renovarPlan(User $user, Plan $plan, Request $request)
    {
        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        $input = $request->all();

        $metodo = $input['metodoPago'];
        $caja = $input['caja'];
        $monto = $input['monto'];

        if ($user->hasFamilia()) {
            $pagable = $user->familia;
        } else {
            $pagable = $user;
        }

        $fecha = Carbon::now()->month($input['periodo'])->format('Y-m-d');
        if ($input['descontar']) {
            $pagable->addPago('Plan adelantado ('.$pagable->name . ') '.$plan->name, $monto - $user->cuenta, $fecha, false, $metodo, $caja);
            foreach ($user->pagosParciales as $pago) {
                $pago->parcial = false;
                $pago->save();
            }

        } else {
            $pagable->addPago('Plan adelantado ('.$pagable->name . ') '.$plan->name, $monto, $fecha, false, $metodo, $caja);
        }
        $user->plans()->find($plan->id)->pivot->renovar();
        //$user->plans()->find($plan->id)->pivot->desadeudar();

        return response()->json($pagable->deudas()->get());
    }
    /**
     * Update the specified User in storage with plan.
     * PUT/PATCH /users/{id}/plan
     *
     * @param  int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function cambiarVencimiento(User $user, Plan $plan, Request $request)
    {
        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        $user->plans()->updateExistingPivot($plan->id,['vencimiento' => Carbon::parse($request->vencimiento)->startOfDay()]);

        return response()->json();
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}/plan
     *
     * @param  int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function addHuella($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        $huella = new Huella();

        $huella->codigo = $input['huella'];

        $user = User::find($id);

        $user->huellas()->save($huella);

        return $this->sendResponse($user->toArray(), 'Usuario editado con exito');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}/plan
     *
     * @param  int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function addTag($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        $tag = new Tag();
        $tag->codigo = $input['tag'];

        $user = User::find($id);

        if ($user->hasTag()) {
            $tagAntiguo = $user->tag();
            $tagAntiguo->delete();
        }

        $user->tag()->save($tag);

        return $this->sendResponse($user->toArray(), 'Usuario editado con exito');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}/plan
     *
     * @param  int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function addDeuda($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        $deuda = new Deuda();

        $user = User::find($id);

        $deuda->precio = $user->aplicarDescuento($input['precio']);

        $deuda->adeudable_id = $id;
        $deuda->adeudable_type = 'App\Models\User';

        if ($user->hasFamilia()) {
            $deuda->adeudable_id = $user->familia->id;
            $deuda->adeudable_type = 'App\Models\Familia';
        }

        $deuda->concepto = "(" . $user->name . ") " . $input['concepto'];

        $deuda->save();

        return $this->sendResponse($user->toArray(), 'Usuario editado con exito');
    }

    /**
     * Show all Planes from one User
     *
     * @param  int $id
     *
     * @return Response
     */

    public function planes($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        return response()->json(User::where('id',$user->id)->with('plans','especials')->get());
    }

    /**
     * Show all Deudas from one User
     *
     * @param  int $id
     *
     * @return Response
     */

    public function deudas($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        DebugBar::addMessage($user->hasFamilia());

        if ($user->hasFamilia()) {
            return response()->json($user->familia->deudas()->get());
        }

        return response()->json($user->deudas()->get());
    }

    public function pagoParcial(User $user, Request $request)
    {
        $input = $request->all();

        $pago = $input['pago'];
        $metodo = $input['metodo'];
        $caja = $input['caja'];

        $deudas = $user->deudas()->orderBy('created_at','asc')->get();
        if ($user->hasFamilia()) {
            $pagable = $user->familia;
        } else {
            $pagable = $user;
        }

        foreach ($deudas as $deuda) {
            if ($deuda->precio > $pago) {
                $pagable->addPago("Pago parcial por " . $pagable->name, $pago, $deuda->created_at, true, $metodo, $caja);
                $deuda->precio -= $pago;
                $pago = 0;
                $deuda->save();
                break;
            } elseif ($deuda->precio < $pago) {
                $pagable->addPago($deuda->concepto, $deuda->precio, $deuda->created_at, false, $metodo, $caja);
                $pago -= $deuda->precio;
                $deuda->delete();
            } else {
                $pagable->addPago($deuda->concepto, $deuda->precio, $deuda->created_at, false, $metodo, $caja);
                $deuda->delete();
                $pago = 0;
                break;
            }
        }

        if ($pago > 0) {
            $pagable->addPago("Pago parcial sobrante de: " . $pagable->name, $pago, Carbon::now(), true, $metodo, $caja);
        }

        return $this->sendResponse($user->toArray(), 'Pago parcial agregado');
    }

    public function pagarDeudas(User $user, Request $request)
    {
        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        $deudas = $request->deudas;
        if ($user->hasFamilia()) {
            $pagable = $user->familia;
        } else {
            $pagable = $user;
        }
        foreach ($deudas as $deudaAux) {
            $deuda = Deuda::find($deudaAux);
            $pagable->addPago($deuda->concepto, $deuda->precio);
            $deuda->deudable->renovar();
            $deuda->deudable->desadeudar();
            $deuda->delete();
        }

        return response()->json($pagable->deudas()->get());
    }

    public function pagarDeuda(User $user, Request $request)
    {
        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        $input = $request->all();
        $metodo = $input['metodoPago'];
        $caja = $input['caja'];

        if ($user->hasFamilia()) {
            $pagable = $user->familia;
        } else {
            $pagable = $user;
        }
        $deuda = Deuda::where('id', $request->deuda)->with('deudable')->first();
        $pagable->addPago($deuda->concepto, $deuda->precio, $deuda->created_at, false, $metodo, $caja);
        if ($deuda->deudable !== null) {
            $deuda->deudable->renovar();
            $deuda->deudable->desadeudar();
            dd($deuda->deudable->pivot());
            $deuda->deudable->pivot()->pagado = 1;
        }
        $deuda->delete();

        return response()->json($pagable->deudas()->get());
    }

    public function detachPlanes(User $user, Request $request)
    {
        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        $planes = $request->planes;

        foreach ($planes as $plan) {
            $user->plans()->detach($plan);
        }

        return response()->json($user->plans()->get());
    }

    /**
     * Add user to Dispositivo en vivo
     *
     * @return Response
     */

    public function usuariosNuevos()
    {
        $users = [];
        $rolAgregar = Role::where('slug', 'agregando')->first();
        $usuarios = Role::with('users')->where('id', $rolAgregar->id)->get()[0]->users; 
        foreach ($usuarios as $user) {
			$res = new \stdClass();
			$res->nombre = $user->name;
			$res->credencial = $user->id;
			$res->huellas = $user->huellas;
			if ($user->hasTag()) {
				$res->tag = $user->tag->codigo;
			} else {
				$res->tag = "";
			}
			$user->revokeRole($rolAgregar->id);
			$users[] = $res;
        }

        return $users;
    }

    public function usuariosNuevos2()
    {
        $users = [];
        $rolAgregar = Role::where('slug', 'agregando')->first();
        $usuarios = User::with('roles')->get();
        foreach ($usuarios as $user) {
            if ($user->isRole('agregando')) {
                $res = new \stdClass();
                $res->nombre = $user->name;
                $res->credencial = $user->id;
                $res->huellas = $user->huellas;
                if ($user->hasTag()) {
                    $res->tag = $user->tag->codigo;
                } else {
                    $res->tag = "";
                }
                $user->revokeRole($rolAgregar->id);
                $users[] = $res;
            }
        }

        return $users;
    }


    public function aplicarDescuento(User $user, Request $request)
    {
        $deudas = $request->deudas;

        foreach ($deudas as $deudaId) {
            $deuda = Deuda::findOrFail($deudaId);
            $deuda->precio = $user->aplicarDescuento($deuda->precio);
            $deuda->save();
        }


        return $this->sendResponse(true,'Deudas borradas con exito');
    }
    public function cambiarSupraestado(User $user, Request $request)
    {
        $user->supraestado = $request->supraestado;

        $user->save();

        return $this->sendResponse(true,'Supraestado modificado de manera exitosa');
    }
}
