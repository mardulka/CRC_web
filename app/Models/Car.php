<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'car';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'car_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'active' => true,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'car_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * Method returning related car_type from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function car_type() {
        return $this->belongsTo( Car_type::class, 'car_type_id', 'car_type_id' );
    }


    /**
     * Method returning related car_category from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function car_category() {
        return $this->belongsTo( Car_category::class, 'car_category_id', 'car_category_id' );
    }


    /**
     * Method returning simulators from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function simulators(){
        return $this->belongsToMany(Simulator::class, 'simulator_car', 'car_id', 'simulator_id', 'car_id', 'simulator_id')
                    ->withPivot('sim_car_id')->withTimestamps();
    }


    /**
     * Method returning all liveries from One ToMany relation.
     *
     * @return HasMany
     */
    public function liveries(){
        return $this->hasMany(Livery::class, 'car_id', 'car_id');
    }


}
