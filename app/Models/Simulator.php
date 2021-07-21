<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Simulator extends Model{
    use HasFactory;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'simulator';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'simulator_id';


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
        'simulator_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Method returning cars from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function cars(){
        return $this->belongsToMany(Car::class, 'simulator_car')->withPivot('simulator_car_identification');
    }


    /**
     * Method returning car categories from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function car_categories(){
        return $this->belongsToMany(Car_category::class, 'simulator_car_category');
    }


    /**
     * Method returning circuit layouts from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function circuit_layouts(){
        return $this->belongsToMany(Circuit_layout::class, 'simulator_circuit_layout');
    }


    /**
     * Method returning all liveries from One ToMany relation.
     *
     * @return HasMany
     */
    public function liveries(){
        return $this->hasMany(Livery::class);
    }


    /**
     * Method returning all related championships from OneToMany relation.
     *
     * @return HasMany
     */
    public function championships(){
        return $this->hasMany( Championship::class );
    }


}
