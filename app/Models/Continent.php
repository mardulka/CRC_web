<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Continent extends Model{
    use HasFactory;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'continent';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'continent_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'continent_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Method returning all related countries from OneToMany relation.
     *
     * @return HasMany
     */
    public function countries(){
        return $this->hasMany( Country::class );
    }


}
