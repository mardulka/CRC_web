<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
     * Method returning related set from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function set() {
        return $this->belongsTo( Set::class , 'set_id', 'set_id');
    }


    /**
     * Method returning related rank from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function rank() {
        return $this->belongsTo( Rank::class, 'rank_id', 'rank_id' );
    }

    /**
     * Method returning related livery from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function livery() {
        return $this->belongsTo( Livery::class, 'livery_id', 'livery_id' );
    }


}
