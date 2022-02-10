<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'application';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'application_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'application_id',
    ];


    /**
     * Method returning related participation from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function participation() {
        return $this->belongsTo( Participation::class , 'participation_id', 'participation_id');
    }


    /**
     * Method returning related class from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function class() {
        return $this->belongsTo( Class_mod::class , 'class_id', 'class_id');
    }


    /**
     * Method returning related livery from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function livery() {
        return $this->belongsTo( Livery::class, 'livery_id', 'livery_id' );
    }


    /**
     * Method returning all related race results from OneToManyThrough relation.
     *
     * @return Collection
     */
    public function raceResults(){
        return $this->participation()->first()->raceResults();
    }

}
