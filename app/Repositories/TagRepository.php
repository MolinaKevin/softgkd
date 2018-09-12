<?php

namespace App\Repositories;

use App\Models\Tag;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TagRepository
 * @package App\Repositories
 * @version September 12, 2018, 12:42 pm -03
 *
 * @method Tag findWithoutFail($id, $columns = ['*'])
 * @method Tag find($id, $columns = ['*'])
 * @method Tag first($columns = ['*'])
*/
class TagRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tag::class;
    }
}
