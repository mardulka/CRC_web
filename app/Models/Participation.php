<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participation extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'participation';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'participation_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'confirmed' => false,
        'active' => true,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'participation_id',
    ];


    /**
     * Method returning related championship from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function championship() {
        return $this->belongsTo( Championship::class, 'championship_id', 'championship_id');
    }


    /**
     * Method returning related user from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo( User::class, 'user_id', 'user_id');
    }


    /**
     * Method returning related crew from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function crew() {
        return $this->belongsTo( Crew::class, 'crew_id', 'crew_id');
    }


    /**
     * Method returning related team from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function team() {
        return $this->belongsTo( Team::class, 'team_id', 'team_id');
    }


    /**
     * Method returning all related applications from OneToMany relation.
     *
     * @return HasMany
     */
    public function applications(){
        return $this->hasMany( Application::class, 'participation_id', 'participation_id');
    }


    /**
     * Method returning all related race results from OneToMany relation.
     *
     * @return HasMany
     */
    public function raceResults(){
        return $this->hasMany( Race_result::class, 'participation_id', 'participation_id');
    }


    /**
     * Method returning all related qualification results from OneToMany relation.
     *
     * @return HasMany
     */
    public function qualificationResults(){
        return $this->hasMany( Qualification_result::class, 'participation_id', 'participation_id');
    }


    /**
     * Method returning all related practice results from OneToMany relation.
     *
     * @return HasMany
     */
    public function practiceResults(){
        return $this->hasMany( Practice_result::class, 'participation_id', 'participation_id' );
    }


}
