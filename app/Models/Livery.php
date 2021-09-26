<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Livery extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'livery';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'livery_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'livery_id',
    ];


    /**
     * Method returning related car from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function car() {
        return $this->belongsTo( Car::class, 'car_id', 'car_id');
    }


    /**
     * Method returning related simulator from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function simulator() {
        return $this->belongsTo( Simulator::class, 'simulator_id', 'simulator_id');
    }


    /**
     * Method returning related user from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo( User::class, 'owner_id', 'user_id')->withDefault();
    }


    /**
     * Method returning all related applications from OneToMany relation.
     *
     * @return HasMany
     */
    public function applications(){
        return $this->hasMany( Application::class, 'livery_id', 'livery_id');
    }


}
