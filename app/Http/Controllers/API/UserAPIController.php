<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Models\Deuda;
use App\Models\Dispositivo;
use App\Models\Huella;
use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Carbon;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DebugBar\DebugBar;

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

        $user = $this->userRepository->update($input, $id);

        $plan = Plan::find($input['plans'][0]);

        switch ($plan->date) {
            case 0:
                $user->plans()->updateExistingPivot($plan->id, ['clases' => $plan->cantidad + $input['adicion']]);
                break;
            case 1:
                $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addDays($plan->cantidad + $input['adicion'])->endOfDay()]);
                break;
            case 2:
                $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addWeek()]);
                break;
            case 3:
                $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addMonth()]);
                break;
            case 4:
                $user->plans()->updateExistingPivot($plan->id, ['vencimiento' => Carbon::now()->addYear()]);
                break;
            default:
                $user->plans()->updateExistingPivot($plan->id, ['clases' => $plan->cantidad + $input['adicion']]);
                break;
        }

        $user->save();

        $plan = $user->plans->find($input['plans'][0]);

        $pivot = PlanUser::find($plan->pivot->id);

        $pivot->adeudar();

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
     * Update the specified User in storage.
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

        return response()->json($user->plans()->wherePivot('pagado', '=', 0)->get());
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

        return response()->json($user->familia->deudas()->get());
    }

    public function pagarPlanes(User $user, Request $request)
    {
        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        $planes = $request->plans;
        $familia = $user->familia;
        foreach ($planes as $planAux) {
            $plan = Plan::find($planAux[0]);
            $familia->pagos()->create([
                'precio' => $plan->cantidad,
                'concepto' => 'Pago de plan: '.$plan->name,
            ]);

            $user->plans()->updateExistingPivot($plan->id, ['pagado' => true]);
        }

        return response()->json($user->plans);
    }

    public function pagarDeudas(User $user, Request $request)
    {
        if (empty($user)) {
            Flash::error('Usuario no encontrado');

            return redirect(route('users.index'));
        }

        $deudas = $request->deudas;
        $familia = $user->familia;
        foreach ($deudas as $deudaAux) {
            $deuda = Deuda::find($deudaAux);
            $familia->pagos()->create([
                'precio' => $deuda->precio,
                'concepto' => 'Pago deuda: '.$deuda->concepto,
            ]);

            $deuda->deudable->renovar();
            $deuda->deudable->desadeudar();
            $deuda->delete();
        }

        return response()->json($user->familia->deudas()->get());
    }

    public function nuevoUsuario()
    {
        $user = User::find(40);
        $disp = Dispositivo::find(1);

        if($user->isRole('agregando')) {
            $res = new \stdClass();
            $res->nombre = $user->name;
            $res->credencial = $user->id;
            $res->huellas = $user->huellas;
            $res->ip = $disp->ip;
            $res->puerto = $disp->puerto;
            $user->revokeRole(10);
            $user = $res;
        } else {
            $user = [];
        }

        return $user->toArray();
    }
}
