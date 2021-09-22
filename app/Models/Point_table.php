<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point_table extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'point_table';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'point_table_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'active' => true,
        'locked' => false,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'point_table_id',
    ];


    /**
     * Method returning all valuations from One ToMany relation.
     *
     * @return HasMany
     */
    public function valuations(){
        return $this->hasMany(Valuation::class, 'point_table_id', 'point_table_id');
    }

    /**
     * Method returning all championships from One ToMany relation.
     *
     * @return HasMany
     */
    public function championships(){
        return $this->hasMany(Championship::class, 'point_table_id', 'point_table_id');
    }


}
