<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Qualification_result extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'qualification_result';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'qualification_result_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'qualification_result_id',
    ];


    /**
     * Method returning related race from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function qualification() {
        return $this->belongsTo( Qualification::class, 'qualification_id', 'qualification_id');
    }


    /**
     * Method returning related participation from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function participation() {
        return $this->belongsTo( Participation::class, 'participation_id', 'participation_id');
    }


    /**
     * Method returning related penalty flag from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function penaltyFlag() {
        return $this->belongsTo( Penalty_flag::class, 'penalty_flag_id', 'penalty_flag_id');
    }



    /**
     * Method returning related penalization from ManyToMany relation.
     *
     * @return BelongsToMany
     */
    public function penalization() {
        return $this->belongsToMany( Penalization::class,  'qualification_result_penalization', 'qualify_result_id', 'penalization_id', 'qualify_result_id', 'penalization_id')
                    ->withTimestamps();
    }


}
