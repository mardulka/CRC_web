<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty_flag extends Model{
    use HasFactory;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'penalty_flag';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'penalty_flag_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'penalty_flag_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


}
