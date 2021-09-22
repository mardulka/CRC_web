<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car_type extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'car_type';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'car_type_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'car_type_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * Method returning related manufacturer from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function manufacturer() {
        return $this->belongsTo( Manufacturer::class, 'manufacturer_id', 'manufacturer_id' );
    }


    /**
     * Method returning all related cars from OneToMany relation.
     *
     * @return HasMany
     */
    public function cars(){
        return $this->hasMany( Car::class, 'car_type_id', 'car_type_id' );
    }


}
