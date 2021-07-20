<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car_category extends Model{
    use HasFactory;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'car_category';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'car_category_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'car_category_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Method returning all related cars from OneToMany relation.
     *
     * @return HasMany
     */
    public function cars(){
        return $this->hasMany( Car::class );
    }


}
