<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Qualification extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'qualification';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'qualification_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'qualification_id',
    ];


    /**
     * Method returning related race from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function race() {
        return $this->belongsTo( Race::class );
    }


}
