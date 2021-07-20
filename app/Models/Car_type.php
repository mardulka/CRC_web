<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car_type extends Model{
    use HasFactory;


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
    public $timestamps = false;


    /**
     * Method returning related manufacturer from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function manufacturer() {
        return $this->belongsTo( Manufacturer::class );
    }


}
