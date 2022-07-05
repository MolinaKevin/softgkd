<?php

namespace App\Repositories;

use App\Models\PlanUser;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PlanUserRepository
 * @package App\Repositories
 * @version February 9, 2018, 11:04 pm UTC
 *
 * @method PlanUser findWithoutFail($id, $columns = ['*'])
 * @method PlanUser find($id, $columns = ['*'])
 * @method PlanUser first($columns = ['*'])
*/
class PlanUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vencimiento',
        'clases',
        'pagado',
        'plan_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PlanUser::class;
    }
}
