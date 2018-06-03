<?php

namespace App\Repositories;

use App\Models\Dispositivo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DispositivoRepository
 * @package App\Repositories
 * @version June 3, 2018, 8:04 pm -03
 *
 * @method Dispositivo findWithoutFail($id, $columns = ['*'])
 * @method Dispositivo find($id, $columns = ['*'])
 * @method Dispositivo first($columns = ['*'])
*/
class DispositivoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'ip',
        'puerto'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Dispositivo::class;
    }
}
