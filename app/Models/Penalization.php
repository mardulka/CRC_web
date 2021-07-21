<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penalization extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'penalization';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'penalization_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'penalization_id',
    ];


}
