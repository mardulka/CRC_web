<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team_participation extends Model{
    use HasFactory, SoftDeletes;

    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'team_participation';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'team_participation_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'confirmed' => false,
        'active'    => true,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'team_participation_id',
    ];


    /**
     * Method returning related championship from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function championship(){
        return $this->belongsTo( Championship::class, 'championship_id', 'championship_id' );
    }

    /**
     * Method returning related team from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function team(){
        return $this->belongsTo( Team::class, 'team_id', 'team_id' );
    }

    /**
     * Method returning all related participation from OneToMany relation.
     *
     * @return HasMany
     */
    public function participation(){
        return $this->hasMany( Participation::class, 'team_participation_id', 'team_participation_id' );
    }


}
