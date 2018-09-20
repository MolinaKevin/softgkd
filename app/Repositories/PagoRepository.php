<?php

namespace App\Repositories;

use App\Models\Pago;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PagoRepository
 * @package App\Repositories
 * @version September 20, 2018, 5:34 pm -03
 *
 * @method Pago findWithoutFail($id, $columns = ['*'])
 * @method Pago find($id, $columns = ['*'])
 * @method Pago first($columns = ['*'])
*/
class PagoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'precio',
        'concepto',
        'pagable_id',
        'pagable_type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pago::class;
    }
}
