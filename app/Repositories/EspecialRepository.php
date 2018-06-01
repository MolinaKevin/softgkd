<?php

namespace App\Repositories;

use App\Models\Especial;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EspecialRepository
 * @package App\Repositories
 * @version June 1, 2018, 4:19 pm -03
 *
 * @method Especial findWithoutFail($id, $columns = ['*'])
 * @method Especial find($id, $columns = ['*'])
 * @method Especial first($columns = ['*'])
*/
class EspecialRepository extends BaseRepository
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
        return Especial::class;
    }
}
