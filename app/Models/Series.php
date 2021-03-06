<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Series extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'series';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'series_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'active' => false,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'series_id',
    ];


    /**
     * Method returning all related championships from OneToMany relation.
     *
     * @return HasMany
     */
    public function championships(){
        return $this->hasMany( Championship::class, 'series_id', 'series_id');
    }

}
