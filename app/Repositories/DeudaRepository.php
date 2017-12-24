<?php

namespace App\Repositories;

use App\Models\Deuda;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DeudaRepository
 *
 * @package App\Repositories
 * @version December 16, 2017, 7:30 am UTC
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
        'familia_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Deuda::class;
    }
}
