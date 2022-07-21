<?php

namespace App\Repositories;

use App\Models\Caja;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CajaRepository
 * @package App\Repositories
 * @version July 21, 2022, 11:20 am -03
 *
 * @method Caja findWithoutFail($id, $columns = ['*'])
 * @method Caja find($id, $columns = ['*'])
 * @method Caja first($columns = ['*'])
*/
class CajaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'cerrado'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Caja::class;
    }
}
