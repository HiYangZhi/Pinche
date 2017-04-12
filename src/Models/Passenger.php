<?php

namespace ZCJY\Pinche\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Passenger
 * @package App\Models
 * @version February 16, 2017, 1:49 am UTC
 */
class Passenger extends Model
{
    use SoftDeletes;

    public $table = 'passengers';
    

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];//要屏蔽的字段


    public $fillable = [
        'openid',
        'contact',
        'nickname',
        'sex',
        'province',
        'city',
        'country',
        'headimgurl',
        'privilege',
        'unionid'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'openid' => 'string',
        'contact' => 'string',
        'nickname' => 'string',
        'sex' => 'string',
        'province' => 'string',
        'city' => 'string',
        'country' => 'string',
        'headimgurl' => 'string',
        'privilege' => 'string',
        'unionid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'openid' => 'required',
        'contact' => 'requried'
    ];

    /**
     * 用户发布的拼车信息
     * @return [type] [description]
     */
    public function infoes()
    {
        return $this->hasMany('ZCJY\Pinche\Models\Info');
    }

    /**
     * 用户参与的拼车信息
     * @return [type] [description]
     */
    public function participations(){
        return $this->belongsToMany('ZCJY\Pinche\Models\Info', 'info_passenger', 'passenger_id', 'info_id')->withPivot('contact', 'seat');
    }
    
}
