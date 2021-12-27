<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model{
    use HasFactory, SoftDeletes;

    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'license';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'license_id';


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
        'license_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * Method returning all user_ranks from One ToMany relation.
     *
     * @return HasMany
     */
    public function userLicenses(){
        return $this->hasMany( User_license::class, 'license_id', 'license_id' );
    }

    /**
     * Method returning simulators from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function simulators(){
        return $this->belongsToMany( Simulator::class, 'simulator_license', 'license_id', 'simulator_id', 'license_id', 'simulator_id' )
                    ->withPivot( 'sim_license_id' )->withTimestamps();
    }

}
