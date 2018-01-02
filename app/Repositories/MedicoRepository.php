<?php

namespace App\Repositories;

use App\Models\Medico;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MedicoRepository
 * @package App\Repositories
 * @version January 2, 2018, 3:11 pm UTC
 *
 * @method Medico findWithoutFail($id, $columns = ['*'])
 * @method Medico find($id, $columns = ['*'])
 * @method Medico first($columns = ['*'])
*/
class MedicoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'role',
        'remember_token',
        'familia_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Medico::class;
    }
}
