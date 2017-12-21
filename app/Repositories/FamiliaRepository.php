<?php

namespace App\Repositories;

use App\Models\Familia;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FamiliaRepository
 * @package App\Repositories
 * @version December 16, 2017, 6:36 am UTC
 *
 * @method Familia findWithoutFail($id, $columns = ['*'])
 * @method Familia find($id, $columns = ['*'])
 * @method Familia first($columns = ['*'])
*/
class FamiliaRepository extends BaseRepository
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
        return Familia::class;
    }
}
