<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Circuit_layout extends Model{
    use HasFactory;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'circuit_layout';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'circuit_layout_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'circuit_layout_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Method returning related circuit from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function circuit() {
        return $this->belongsTo( Circuit::class );
    }


    /**
     * Method returning simulators from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function simulators(){
        return $this->belongsToMany(Simulator::class, 'simulator_circuit_layout');
    }


}
