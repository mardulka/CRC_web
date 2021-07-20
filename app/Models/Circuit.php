<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Circuit extends Model{
    use HasFactory;


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
     * The attributes that are mass assignable.
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
        return $this->belongsTo( Country::class );
    }


}
