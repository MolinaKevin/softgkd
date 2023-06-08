<?php

namespace App\Repositories;

use App\Models\MetodoPago;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MetodoPagoRepository
 * @package App\Repositories
 * @version July 5, 2022, 2:51 pm -03
 *
 * @method MetodoPago findWithoutFail($id, $columns = ['*'])
 * @method MetodoPago find($id, $columns = ['*'])
 * @method MetodoPago first($columns = ['*'])
*/
class MetodoPagoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'cash'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MetodoPago::class;
    }
}
