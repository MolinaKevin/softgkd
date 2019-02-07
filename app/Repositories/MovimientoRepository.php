<?php

namespace App\Repositories;

use App\Models\Movimiento;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MovimientoRepository
 * @package App\Repositories
 * @version February 7, 2019, 11:54 am -03
 *
 * @method Movimiento findWithoutFail($id, $columns = ['*'])
 * @method Movimiento find($id, $columns = ['*'])
 * @method Movimiento first($columns = ['*'])
*/
class MovimientoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'precio',
        'concepto'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Movimiento::class;
    }
}
