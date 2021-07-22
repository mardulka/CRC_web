<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Practice_result extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'practice_result';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'practice_result_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'practice_result_id',
    ];


    /**
     * Method returning related practice from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function practice() {
        return $this->belongsTo( Practice::class );
    }


    /**
     * Method returning related participation from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function participation() {
        return $this->belongsTo( Participation::class );
    }


    /**
     * Method returning related penalty flag from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function penaltyFlag() {
        return $this->belongsTo( Penalty_flag::class );
    }



    /**
     * Method returning related penalization from ManyToMany relation.
     *
     * @return BelongsToMany
     */
    public function penalization() {
        return $this->belongsToMany( Penalization::class,  'practice_result_penalization')->withTimestamps();
    }


}
