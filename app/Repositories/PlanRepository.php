<?php

namespace App\Repositories;

use App\Models\Plan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PlanRepository
 * @package App\Repositories
 * @version December 16, 2017, 6:39 am UTC
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
        'precio'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Plan::class;
    }
}
