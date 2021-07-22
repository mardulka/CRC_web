<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penalty_flag extends Model{
    use HasFactory;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'penalty_flag';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'penalty_flag_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'penalty_flag_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Method returning all related race results from OneToMany relation.
     *
     * @return HasMany
     */
    public function raceResults(){
        return $this->hasMany( Race_result::class );
    }


    /**
     * Method returning all related qualification results from OneToMany relation.
     *
     * @return HasMany
     */
    public function qualificationResults(){
        return $this->hasMany( Qualification_result::class );
    }


    /**
     * Method returning all related practice results from OneToMany relation.
     *
     * @return HasMany
     */
    public function practiceResults(){
        return $this->hasMany( Practice_result::class );
    }


}
