<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Simulator extends Model{
    use HasFactory, SoftDeletes;


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
    public $timestamps = true;


    /**
     * Method returning cars from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function cars(){
        return $this->belongsToMany( Car::class, 'simulator_car', 'simulator_id', 'car_id', 'simulator_id', 'car_id' )
                    ->withPivot( 'sim_car_id' )->withTimestamps();
    }

    /**
     * Method returning countries from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function countries(){
        return $this->belongsToMany( Country::class, 'simulator_car', 'simulator_id', 'country_id', 'simulator_id', 'country_id' )
                    ->withPivot( 'sim_country_id' )->withTimestamps();
    }


    /**
     * Method returning car categories from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function car_categories(){
        return $this->belongsToMany( Car_category::class, 'simulator_car_category', 'simulator_id', 'car_category_id', 'simulator_id', 'car_category_id' );
    }


    /**
     * Method returning cup categories from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function cup_categories(){
        return $this->belongsToMany( Cup_category::class, 'simulator_cup_category', 'simulator_id', 'cup_category_id', 'simulator_id', 'cup_category_id' )
                    ->withPivot( 'sim_cup_categ_id' )->withTimestamps();
    }


    /**
     * Method returning ranks from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function ranks(){
        return $this->belongsToMany( Rank::class, 'simulator_car', 'simulator_id', 'rank_id', 'simulator_id', 'rank_id' )
                    ->withPivot( 'sim_rank_id' )->withTimestamps();
    }


    /**
     * Method returning circuit layouts from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function circuit_layouts(){
        return $this->belongsToMany( Circuit_layout::class, 'simulator_circuit_layout', 'simulator_id', 'circuit_layout_id', 'simulator_id', 'circuit_layout_id' )
                    ->withTimestamps();
    }


    /**
     * Method returning all liveries from One ToMany relation.
     *
     * @return HasMany
     */
    public function liveries(){
        return $this->hasMany( Livery::class, 'simulator_id', 'simulator_id' );
    }


    /**
     * Method returning all related championships from OneToMany relation.
     *
     * @return HasMany
     */
    public function championships(){
        return $this->hasMany( Championship::class, 'simulator_id', 'simulator_id' );
    }


}
