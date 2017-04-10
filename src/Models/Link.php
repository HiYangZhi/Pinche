<?php

namespace ZCJY\Pinche\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Link
 * @package App\Models
 * @version February 20, 2017, 5:50 am UTC
 */
class Link extends Model
{
    use SoftDeletes;

    public $table = 'links';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'intro',
        'url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'intro' => 'string',
        'url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
