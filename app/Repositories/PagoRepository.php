<?php

namespace App\Repositories;

use App\Models\Pago;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PagoRepository
 * @package App\Repositories
 * @version December 19, 2017, 5:28 am UTC
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
        'familia_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pago::class;
    }
}
