<?php

namespace App\Repositories;

use App\Models\TipoPago;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TipoPagoRepository
 * @package App\Repositories
 * @version July 23, 2022, 7:29 am -03
 *
 * @method TipoPago findWithoutFail($id, $columns = ['*'])
 * @method TipoPago find($id, $columns = ['*'])
 * @method TipoPago first($columns = ['*'])
*/
class TipoPagoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TipoPago::class;
    }
}
