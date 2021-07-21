<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participation extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'participation';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'participation_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'confirmed' => false,
        'active' => true,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'participation_id',
    ];


    /**
     * Method returning related championship from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function championship() {
        return $this->belongsTo( Championship::class );
    }


    /**
     * Method returning related user from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo( User::class );
    }


    /**
     * Method returning related crew from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function crew() {
        return $this->belongsTo( Crew::class );
    }


    /**
     * Method returning related team from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function team() {
        return $this->belongsTo( Team::class );
    }


    /**
     * Method returning related rank from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function rank() {
        return $this->belongsTo( Rank::class );
    }


}
