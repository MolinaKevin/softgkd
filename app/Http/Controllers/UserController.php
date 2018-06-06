<?php

namespace App\Http\Controllers;

use App\DataTables\PlanDataTable;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('permission:users.index')->only('index');
        $this->middleware('permission:users.create')->only(['create','store']);
        $this->middleware('permission:users.edit')->only(['edit','update']);
        $this->middleware('permission:users.show')->only('show');
        $this->middleware('permission:users.destroy')->only('destroy');
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->q) {
            $users = $this->userRepository->orderBy('first_name', 'asc')->findLike($request->q, 'first_name', 'last_name');
        } else {
            $this->userRepository->pushCriteria(new RequestCriteria($request));
            $users = $this->userRepository->orderBy('first_name', 'asc')->all();
        }

        $roles = Role::all();

        return view('users.index', compact('roles'))->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        if ($input['descuento'] == null || $input['descuento'] < 0) {
            $input['descuento'] = 0;
        } elseif ($input['descuento'] > 100) {
            $input['descuento'] = 100;
        }

        $user = $this->userRepository->create($input);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $roles = Role::all();

        return view('users.edit', compact('roles'))->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
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

        return view('users.plans')->with('plans', $user->plans)->with('user', $user);
    }

    /**
     * Show all Planes from one User
     *
     * @param  string $string
     *
     * @return Response
     */

    public function roles($string)
    {
        $users = User::whereHas('roles', function ($q) use ($string) {
            $q->where('name', $string);
        })->get();

        if (empty($users)) {
            Flash::error('Algo malo ocurrio');

            return redirect(route('users.index'));
        }

        return view('users.index')->with('users', $users);
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
            $users = $this->userRepository->orderBy('first_name', 'asc')->findLike($request->q, 'first_name', 'last_name');
            if ($users) {
                foreach ($users as $key => $user) {
                    $output .= "<tr data-id=\"$user->id\">"
                        . "<td>$user->name</td>"
                        . "<td>$user->badge_estado</td>"
                        . "<td>$user->email</td>"
                        . "<td>" . link_to_route('familias.index', $user->familia->name, ['q' => $user->familia->name]) . "</td>"
                        . "<td>"
                            . '<div class="btn-group">'
                                . '<a href="#" class="btn btn-success btn-xs btnPago"><i class="glyphicon glyphicon-usd"></i></a>'
                                . '<a href="#" class="btn btn-default btn-xs btnPlan"><i class="glyphicon glyphicon-plus"></i></a>'
                                . "<a href=\"" . route('especials.user.create', [$user->id]) . "\" class='btn btn-warning btn-xs'><i class=\"glyphicon glyphicon-plus\"></i></a>"
                                . '<a href="#" class="btn btn-default btn-xs btnHuella"><i class="glyphicon glyphicon-record"></i></a>'
                                . '<a href="' . route('users.plans', [$user->id]) . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-list-alt"></i></a>'
                                . '<a href="' . route('users.show', [$user->id]) . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>'
                                . '<a href="' . route('users.edit', [$user->id]) . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>'
                                . '<a href="#" class="btn btn-danger btn-xs btnDelete"><i class="glyphicon glyphicon-trash"></i></a>'
                            . '</div>'
                        . '</td>'
                    . '</tr>';
                }
                return $output;
            }
        }
    }
}
