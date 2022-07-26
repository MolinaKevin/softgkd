<?php

namespace App\Repositories;

use App\Models\Cierre;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CierreRepository
 * @package App\Repositories
 * @version July 26, 2022, 6:45 am -03
 *
 * @method Cierre findWithoutFail($id, $columns = ['*'])
 * @method Cierre find($id, $columns = ['*'])
 * @method Cierre first($columns = ['*'])
*/
class CierreRepository extends BaseRepository
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
        return Cierre::class;
    }
}
