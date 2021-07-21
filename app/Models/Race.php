<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Race extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'race';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'race_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'mand_pits' => 1,
        'mand_wheels' => true,
        'mand_refuel' => true,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'race_id',
    ];


    /**
     * Method returning related set from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function set() {
        return $this->belongsTo( Set::class );
    }


    /**
     * Method returning related circuit layout from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function circuitLayout() {
        return $this->belongsTo( Circuit_layout::class );
    }


    /**
     * Method returning all related qualifications from OneToMany relation.
     *
     * @return HasMany
     */
    public function qualifications(){
        return $this->hasMany( Qualification::class );
    }


    /**
     * Method returning all related practices from OneToMany relation.
     *
     * @return HasMany
     */
    public function practices(){
        return $this->hasMany( Practice::class );
    }


}
