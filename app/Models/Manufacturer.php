<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Manufacturer extends Model{
    use HasFactory;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'manufacturer';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'manufacturer_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'manufacturer_id',
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
