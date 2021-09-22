<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car_category extends Model{
    use HasFactory, SoftDeletes;


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
    public $timestamps = true;


    /**
     * Method returning simulators from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function simulators(){
        return $this->belongsToMany(Simulator::class, 'simulator_car_category','car_category_id', 'simulator_id', 'car_category_id', 'simulator_id');
    }


    /**
     * Method returning related sets from ManyToMany relation.
     *
     * @return BelongsToMany
     */
    public function sets() {
        return $this->belongsToMany( Set::class,  'car_category_set', 'car_category_id', 'set_id', 'car_category_id', 'set_id')
                    ->withTimestamps();
    }


    /**
     * Method returning all related cars from OneToMany relation.
     *
     * @return HasMany
     */
    public function cars(){
        return $this->hasMany( Car::class, 'car_category_id', 'car_category_id');
    }


}
