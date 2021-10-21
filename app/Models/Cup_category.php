<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cup_category extends Model{
    use HasFactory, SoftDeletes;

    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'cup_category';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'cup_category_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'active' => true,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'cup_category_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * Method returning simulators from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function simulators(){
        return $this->belongsToMany( Simulator::class, 'simulator_cup_category', 'cup_category_id', 'simulator_id', 'cup_category_id', 'simulator_id' )
                    ->withPivot( 'sim_cup_categ_id' )->withTimestamps();
    }

}
