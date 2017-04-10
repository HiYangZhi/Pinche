<?php

namespace ZCJY\Pinche\Repositories;

use ZCJY\Pinche\Models\Info;
use InfyOm\Generator\Common\BaseRepository;

class InfoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'departure',
        'destination',
        'time',
        'price',
        'seat',
        'seat_taken',
        'contact',
        'info',
        'passenger_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Info::class;
    }

    //根据查询参数获取拼车信息
    public function info_list($type, $dep, $des, $time, $offset, $num){
        $querybuilder = Info::where( 'type', $type );
        if ( !is_null($dep) ) {
            $querybuilder = $querybuilder->where('departure', 'like', '%'.$dep.'%');
        }
        if ( !is_null($des) ) {
            $querybuilder = $querybuilder->where('destination', 'like', '%'.$des.'%');
        }
        if ( !is_null($time) ) {
            $querybuilder = $querybuilder->whereDate( 'time', $time );
        }
        try {
            return $querybuilder->skip($offset)->take($num)->get();
        } catch (Exception $e) {
            return;
        }
    }

    //分页查询乘车信息
    public function listPage($type, $dep, $des, $time)
    {
        $querybuilder = Info::where( 'type', $type );
        if ( !is_null($dep) ) {
            $querybuilder = $querybuilder->where('departure', 'like', '%'.$dep.'%');
        }
        if ( !is_null($des) ) {
            $querybuilder = $querybuilder->where('destination', 'like', '%'.$des.'%');
        }
        if ( !is_null($time) ) {
            $querybuilder = $querybuilder->whereDate( 'time', $time );
        }
        return $querybuilder->orderBy('time', 'desc')->paginate(10);
    }
}
