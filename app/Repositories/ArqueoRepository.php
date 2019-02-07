<?php

namespace App\Repositories;

use App\Models\Arqueo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ArqueoRepository
 * @package App\Repositories
 * @version February 6, 2019, 4:31 pm -03
 *
 * @method Arqueo findWithoutFail($id, $columns = ['*'])
 * @method Arqueo find($id, $columns = ['*'])
 * @method Arqueo first($columns = ['*'])
*/
class ArqueoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'total'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Arqueo::class;
    }
}
