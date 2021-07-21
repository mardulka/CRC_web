<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model{
    use HasFactory, softDeletes;


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
        return $this->hasMany(Membership::class);
    }


    /**
     * Method returning all related participation from OneToMany relation.
     *
     * @return HasMany
     */
    public function participation(){
        return $this->hasMany( Participation::class );
    }


}
