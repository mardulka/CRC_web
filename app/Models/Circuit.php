<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Circuit extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'circuit';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'circuit_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'circuit_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Method returning related country from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function country() {
        return $this->belongsTo( Country::class, 'country_id', 'country_id' );
    }


    /**
     * Method returning all related circuit layouts from OneToMany relation.
     *
     * @return HasMany
     */
    public function circuit_layouts() {
        return $this->hasMany( Circuit_layout::class, 'circuit_id', 'circuit_id' );
    }


}
