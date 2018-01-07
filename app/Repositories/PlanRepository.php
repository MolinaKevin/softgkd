<?php

namespace App\Repositories;

use App\Models\Plan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PlanRepository
 * @package App\Repositories
 * @version January 6, 2018, 4:54 pm UTC
 *
 * @method Plan findWithoutFail($id, $columns = ['*'])
 * @method Plan find($id, $columns = ['*'])
 * @method Plan first($columns = ['*'])
*/
class PlanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'precio',
        'cantidad',
        'date',
        'porDia',
        'limite'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Plan::class;
    }
}
