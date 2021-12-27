<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Championship extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'championship';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'championship_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'public' => false,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'championship_id',
    ];


    /**
     * Method returning related season from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function season(){
        return $this->belongsTo( Season::class, 'season_id', 'season_id' );
    }


    /**
     * Method returning related series from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function series(){
        return $this->belongsTo( Series::class, 'series_id', 'series_id' );
    }


    /**
     * Method returning related simulator from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function simulator(){
        return $this->belongsTo( Simulator::class, 'simulator_id', 'simulator_id' );
    }


    /**
     * Method returning related point table from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function point_table(){
        return $this->belongsTo( Point_table::class, 'point_table_id', 'point_table_id' );
    }



    /**
     * Method returning crews from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function organizers(){
        return $this->BelongsToMany( User::class, 'organizing', 'championship_id', 'user_id', 'championship_id', 'user_id' )->withTimestamps();
    }


    /**
     * Method returning all related participation from OneToMany relation.
     *
     * @return HasMany
     */
    public function participation(){
        return $this->hasMany( Participation::class, 'championship_id', 'championship_id' );
    }


    /**
     * Method returning all related sets from OneToMany relation.
     *
     * @return HasMany
     */
    public function sets(){
        return $this->hasMany( Set::class, 'championship_id', 'championship_id' );
    }


    /**
     * Method returning all races belong to championship through sets.
     *
     * @return HasManyThrough
     */
    public function races(){
        return $this->hasManyThrough( Race::class, Set::class, 'championship_id', 'set_id', 'championship_id', 'set_id', );
    }


}
