<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'season';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'season_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'active' => false,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'season_id',
    ];


    /**
     * Method returning all related championships from OneToMany relation.
     *
     * @return HasMany
     */
    public function championships(){
        return $this->hasMany( Championship::class );
    }

}
