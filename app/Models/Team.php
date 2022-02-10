<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'team';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'team_id';


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
        'team_id',
    ];


    /**
     * Method returning all memberships from One ToMany relation.
     *
     * @return HasMany
     */
    public function memberships(){
        return $this->hasMany(Membership::class, 'team_id', 'team_id');
    }


    /**
     * Method returning all related team_participation from OneToMany relation.
     *
     * @return HasMany
     */
    public function teamParticipations(){
        return $this->hasMany( Team_participation::class, 'team_id', 'team_id');
    }


}
