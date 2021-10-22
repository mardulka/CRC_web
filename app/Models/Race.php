<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Race extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'race';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'race_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'mand_pits' => 1,
        'mand_wheels' => true,
        'mand_refuel' => true,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'race_id',
    ];


    /**
     * Method returning related set from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function set() {
        return $this->belongsTo( Set::class, 'set_id', 'set_id');
    }


    /**
     * Method returning related circuit layout from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function circuitLayout() {
        return $this->belongsTo( Circuit_layout::class, 'circuit_layout_id', 'circuit_layout_id');
    }


    /**
     * Method returning all related qualifications from OneToMany relation.
     *
     * @return HasMany
     */
    public function qualifications(){
        return $this->hasMany( Qualification::class, 'race_id', 'race_id');
    }


    /**
     * Method returning all related practices from OneToMany relation.
     *
     * @return HasMany
     */
    public function practices(){
        return $this->hasMany( Practice::class, 'race_id', 'race_id');
    }


    /**
     * Method returning all related race results from OneToMany relation.
     *
     * @return HasMany
     */
    public function raceResults(){
        return $this->hasMany( Race_result::class, 'race_id', 'race_id');
    }


    /**
     * Method returning all server configs from OneToMany relation.
     *
     * @return HasMany
     */
    public function serverConfigs(){
        return $this->hasMany( Server_config::class, 'race_id', 'race_id');
    }


}
