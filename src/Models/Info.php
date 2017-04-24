<?php

namespace ZCJY\Pinche\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Info
 * @package App\Models
 * @version February 16, 2017, 1:43 am UTC
 */
class Info extends Model
{
    use SoftDeletes;

    public $table = 'infos';
    

    protected $dates = ['deleted_at', 'time'];

    protected $hidden = ['deleted_at'];//要屏蔽的字段


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'integer',
        'departure' => 'string',
        'destination' => 'string',
        'price' => 'integer',
        'seat' => 'integer',
        'seat_taken' => 'integer',
        'contact' => 'string',
        'info' => 'string',
        'passenger_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'departure' => 'required',
        'destination' => 'required',
        'time' => 'required',
        'seat' => 'required',
        'contact' => 'required',
        'price' => 'required',
    ];

    /**
     * 返回信息发布人
     * @return [type] [description]
     */
    public function publisher(){
        return $this->belongsTo('ZCJY\Pinche\Models\Passenger', 'passenger_id');
    }
    

    /**
     * 报名参加拼车的用户
     * @return [type] [description]
     */
    public function passengers(){
        return $this->belongsToMany('ZCJY\Pinche\Models\Passenger', 'info_passenger', 'info_id', 'passenger_id')->withPivot('contact', 'seat');
    }
}
