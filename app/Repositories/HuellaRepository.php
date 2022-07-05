<?php

namespace App\Repositories;

use App\Models\Huella;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HuellaRepository
 * @package App\Repositories
 * @version May 27, 2018, 11:23 am -03
 *
 * @method Huella findWithoutFail($id, $columns = ['*'])
 * @method Huella find($id, $columns = ['*'])
 * @method Huella first($columns = ['*'])
*/
class HuellaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Huella::class;
    }
}
