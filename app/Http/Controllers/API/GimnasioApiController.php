<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Http\Requests\CreateAsistenciaRequest;
use App\Http\Requests\UpdateAsistenciaRequest;
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
        $users = User::all();

        $retorno = [];
        foreach ($users as $user) {
            if (! $user->hasDeuda()) {
                $retorno[] = $user;
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

        $asistencia = $this->asistenciaRepository->create($input);
        
        Flash::success('Asistencia saved successfully.');

        return redirect(route('asistencias.index'));
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
