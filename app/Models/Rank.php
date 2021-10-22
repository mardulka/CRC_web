<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rank extends Model{
    use HasFactory, SoftDeletes;

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
    public $timestamps = true;


    /**
     * Method returning all user_ranks from One ToMany relation.
     *
     * @return HasMany
     */
    public function user_ranks(){
        return $this->hasMany( User_rank::class, 'rank_id', 'rank_id' );
    }


    /**
     * Method returning all related applications from OneToMany relation.
     *
     * @return HasMany
     */
    public function applications(){
        return $this->hasMany( Application::class, 'rank_id', 'rank_id' );
    }

    /**
     * Method returning simulators from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function simulators(){
        return $this->belongsToMany( Simulator::class, 'simulator_rank', 'rank_id', 'simulator_id', 'rank_id', 'simulator_id' )
                    ->withPivot( 'sim_rank_id' )->withTimestamps();
    }


    /**
     * Method returning ranks from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function championships(){
        return $this->belongsToMany( Championship::class, 'championship_rank', 'rank_id', 'championship_id', 'rank_id', 'championship_id' )
                    ->withPivot( 'rank_order' )->withTimestamps();
    }

}
