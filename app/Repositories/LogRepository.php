<?php

namespace App\Repositories;

use App\Models\Log;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LogRepository
 * @package App\Repositories
 * @version November 20, 2022, 1:01 pm -03
 *
 * @method Log findWithoutFail($id, $columns = ['*'])
 * @method Log find($id, $columns = ['*'])
 * @method Log first($columns = ['*'])
*/
class LogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'message'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Log::class;
    }
}
