<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penalization extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'penalization';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'penalization_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'penalization_id',
    ];


    /**
     * Method returning related race results from ManyToMany relation.
     *
     * @return BelongsToMany
     */
    public function raceResults() {
        return $this->belongsToMany( Race_result::class,  'race_result_penalization')->withTimestamps();
    }


    /**
     * Method returning related qualification results from ManyToMany relation.
     *
     * @return BelongsToMany
     */
    public function qualificationResults() {
        return $this->belongsToMany( Qualification_result::class,  'qualification_result_penalization')->withTimestamps();
    }


    /**
     * Method returning related practice results from ManyToMany relation.
     *
     * @return BelongsToMany
     */
    public function practiceResults() {
        return $this->belongsToMany( Practice_result::class,  'practice_result_penalization')->withTimestamps();
    }


}
