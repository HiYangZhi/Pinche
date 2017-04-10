<?php

namespace ZCJY\Pinche\Repositories;

use ZCJY\Pinche\Models\Link;
use InfyOm\Generator\Common\BaseRepository;

class LinkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'intro',
        'url'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Link::class;
    }
}
