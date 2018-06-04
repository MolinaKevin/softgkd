<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Http\Requests\CreateAsistenciaRequest;
use App\Http\Requests\UpdateAsistenciaRequest;
use App\Models\Asistencia;
use App\Repositories\AsistenciaRepository;
use App\Models\Deuda;
use App\Models\Pago;
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

/**
 * Class UserController
 *
 * @package App\Http\Controllers\API
 */
class GimnasioAPIController extends AppBaseController
{
    /** @var  AsistenciaRepository */
    private $asistenciaRepository;
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo, AsistenciaRepository $asistenciaRepo)
    {
        $this->userRepository = $userRepo;
        $this->asistenciaRepository = $asistenciaRepo;
    }

    /**
     * Display a listing of the User.
     * GET|HEAD /users
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $users = User::select('id','first_name','last_name','familia_id')->get();

        $retorno = [];
        foreach ($users as $user) {
            if (! $user->hasDeuda()) {
                $res = new \stdClass();
                $res->nombre = $user->name;
                $res->credencial = $user->id;
                $res->huellas = $user->huellas;
                $res->familia = $user->familia->name;
                $retorno[] = $res;
            }
        }

        return $retorno;
    }

    /**
     * Store a newly created User in storage.
     * POST /users
     *
     * @param CreateUserAPIRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        foreach ($input as $item) {
            $asistencia = [];
            $asistencia['user_id'] = $item['credencial'];
            $asistencia['horario'] = $item['horario'];
            $asistencia['actividad'] = $item['actividad'];
            $this->asistenciaRepository->create($asistencia);
        }

        return response("Success//".$asistencia['horario'],200);

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
        //
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
        //
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
        //
    }
}
