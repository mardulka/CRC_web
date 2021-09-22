<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Practice extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'practice';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'practice_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'practice_id',
    ];


    /**
     * Method returning related race from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function race() {
        return $this->belongsTo( Race::class, 'race_id', 'race_id');
    }


    /**
     * Method returning all related practice results from OneToMany relation.
     *
     * @return HasMany
     */
    public function practiceResults(){
        return $this->hasMany( Practice_result::class, 'practice_id', 'practice_id');
    }

}
