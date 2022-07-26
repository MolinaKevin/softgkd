<?php

namespace App\Repositories;

use App\Models\Cierres;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CierresRepository
 * @package App\Repositories
 * @version July 26, 2022, 6:45 am -03
 *
 * @method Cierres findWithoutFail($id, $columns = ['*'])
 * @method Cierres find($id, $columns = ['*'])
 * @method Cierres first($columns = ['*'])
*/
class CierresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Cierres::class;
    }
}
