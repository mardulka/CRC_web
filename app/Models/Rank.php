<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rank extends Model{
    use HasFactory, softDeletes;

    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'rank';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'rank_id';


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
        'rank_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Method returning all user_ranks from One ToMany relation.
     *
     * @return HasMany
     */
    public function user_ranks(){
        return $this->hasMany(User_rank::class);
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
