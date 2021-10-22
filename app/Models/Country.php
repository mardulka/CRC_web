<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model{
    use HasFactory, SoftDeletes;

    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'country';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'country_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'country_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Method returning related continent from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function continent(){
        return $this->belongsTo( Continent::class, 'continent_id', 'continent_id' );
    }


    /**
     * Method returning all related users from OneToMany relation.
     *
     * @return HasMany
     */
    public function users(){
        return $this->hasMany( User::class, 'country_id', 'country_id' );
    }


    /**
     * Method returning all related circuits from OneToMany relation.
     *
     * @return HasMany
     */
    public function circuits(){
        return $this->hasMany( Circuit::class, 'country_id', 'country_id' );
    }


    /**
     * Method returning all related manufacturers from OneToMany relation.
     *
     * @return HasMany
     */
    public function manufacturers(){
        return $this->hasMany( Manufacturer::class, 'country_id', 'country_id' );
    }


    /**
     * Method returning simulators from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function simulators(){
        return $this->belongsToMany( Simulator::class, 'simulator_country', 'country_id', 'simulator_id', 'country_id', 'simulator_id' )
                    ->withPivot( 'sim_country_id' )->withTimestamps();
    }


}
