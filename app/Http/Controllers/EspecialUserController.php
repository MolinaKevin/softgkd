<?php

namespace App\Http\Controllers;

use App\DataTables\EspecialUserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateEspecialUserRequest;
use App\Http\Requests\UpdateEspecialUserRequest;
use App\Repositories\EspecialUserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class EspecialUserController extends AppBaseController
{
    /** @var  EspecialUserRepository */
    private $especialUserRepository;

    public function __construct(EspecialUserRepository $especialUserRepo)
    {
        $this->especialUserRepository = $especialUserRepo;
    }

    /**
     * Display a listing of the EspecialUser.
     *
     * @param EspecialUserDataTable $especialUserDataTable
     * @return Response
     */
    public function index(EspecialUserDataTable $especialUserDataTable)
    {
        return $especialUserDataTable->render('especial_users.index');
    }

    /**
     * Show the form for creating a new EspecialUser.
     *
     * @return Response
     */
    public function create()
    {
        return view('especial_users.create');
    }

    /**
     * Store a newly created EspecialUser in storage.
     *
     * @param CreateEspecialUserRequest $request
     *
     * @return Response
     */
    public function store(CreateEspecialUserRequest $request)
    {
        $input = $request->all();

        $especialUser = $this->especialUserRepository->create($input);

        Flash::success('Especial User saved successfully.');

        return redirect(route('especialUsers.index'));
    }

    /**
     * Display the specified EspecialUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $especialUser = $this->especialUserRepository->findWithoutFail($id);

        if (empty($especialUser)) {
            Flash::error('Especial User not found');

            return redirect(route('especialUsers.index'));
        }

        return view('especial_users.show')->with('especialUser', $especialUser);
    }

    /**
     * Show the form for editing the specified EspecialUser.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $especialUser = $this->especialUserRepository->findWithoutFail($id);

        if (empty($especialUser)) {
            Flash::error('Especial User not found');

            return redirect(route('especialUsers.index'));
        }

        return view('especial_users.edit')->with('especialUser', $especialUser);
    }

    /**
     * Update the specified EspecialUser in storage.
     *
     * @param  int              $id
     * @param UpdateEspecialUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEspecialUserRequest $request)
    {
        $especialUser = $this->especialUserRepository->findWithoutFail($id);

        if (empty($especialUser)) {
            Flash::error('Especial User not found');

            return redirect(route('especialUsers.index'));
        }

        $especialUser = $this->especialUserRepository->update($request->all(), $id);

        Flash::success('Especial User updated successfully.');

        return redirect(route('especialUsers.index'));
    }

    /**
     * Remove the specified EspecialUser from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $especialUser = $this->especialUserRepository->findWithoutFail($id);

        if (empty($especialUser)) {
            Flash::error('Especial User not found');

            return redirect(route('especialUsers.index'));
        }

        $this->especialUserRepository->delete($id);

        Flash::success('Especial User deleted successfully.');

        return redirect(route('especialUsers.index'));
    }
}
