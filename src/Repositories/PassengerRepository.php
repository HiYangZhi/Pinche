<?php

namespace ZCJY\Pinche\Repositories;

use ZCJY\Pinche\Models\Passenger;
use InfyOm\Generator\Common\BaseRepository;

class PassengerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'openid',
        'contact'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Passenger::class;
    }
}
