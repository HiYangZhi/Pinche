<?php

namespace ZCJY\Pinche\Repositories;

use ZCJY\Pinche\Models\banner;
use InfyOm\Generator\Common\BaseRepository;

class bannerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pic_source',
        'url'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return banner::class;
    }
}
