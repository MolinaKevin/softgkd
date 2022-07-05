<?php

namespace App\Repositories;

use App\Models\EspecialUser;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EspecialUserRepository
 * @package App\Repositories
 * @version June 1, 2018, 6:14 pm -03
 *
 * @method EspecialUser findWithoutFail($id, $columns = ['*'])
 * @method EspecialUser find($id, $columns = ['*'])
 * @method EspecialUser first($columns = ['*'])
*/
class EspecialUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vencimiento',
        'clases',
        'pagado',
        'especial_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EspecialUser::class;
    }
}
