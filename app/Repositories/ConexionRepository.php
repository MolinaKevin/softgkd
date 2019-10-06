<?php

namespace App\Repositories;

use App\Models\Conexion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ConexionRepository
 * @package App\Repositories
 * @version October 5, 2019, 1:32 pm -03
 *
 * @method Conexion findWithoutFail($id, $columns = ['*'])
 * @method Conexion find($id, $columns = ['*'])
 * @method Conexion first($columns = ['*'])
*/
class ConexionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'concepto'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Conexion::class;
    }
}
