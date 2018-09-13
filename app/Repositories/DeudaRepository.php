<?php

namespace App\Repositories;

use App\Models\Deuda;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DeudaRepository
 * @package App\Repositories
 * @version September 13, 2018, 2:46 am -03
 *
 * @method Deuda findWithoutFail($id, $columns = ['*'])
 * @method Deuda find($id, $columns = ['*'])
 * @method Deuda first($columns = ['*'])
*/
class DeudaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'precio',
        'concepto',
        'deudable_id',
        'deudable_type',
        'adeudable_id',
        'adeudable_type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Deuda::class;
    }
}
