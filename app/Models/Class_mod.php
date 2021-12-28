<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Class_mod extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'class';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'class_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'class_id',
    ];


    /**
     * Method returning related race_category from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function raceCategory(){
        return $this->belongsTo( Race_category::class, 'race_category_id', 'race_category_id' );
    }


    /**
     * Method returning related set from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function set(){
        return $this->belongsTo( Set::class, 'set_id', 'set_id' );
    }

    /**
     * Method returning all related applications from OneToMany relation.
     *
     * @return HasMany
     */
    public function applications(){
        return $this->hasMany( Application::class, 'class_id', 'class_id' );
    }

    /**
     * Method returning all related participation from OneToMany relation.
     *
     * @return HasManyThrough
     */
    public function participation(){
        return $this->hasManyThrough( Participation::class, Application::class, 'class_id', 'participation_id', 'class_id', 'participation_id' );
    }


}
