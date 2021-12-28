<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Race_category extends Model{
    use HasFactory, SoftDeletes;

    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'race_category';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'race_category_id';


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
        'race_category_id',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    /**
     * Method returning all related classes from OneToMany relation.
     *
     * @return HasMany
     */
    public function classes(){
        return $this->hasMany( Class_mod::class, 'race_category_id', 'race_category_id' );
    }


    /**
     * Method returning related car category from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function carCategory(){
        return $this->belongsTo( Car_category::class, 'car_category_id', 'car_category_id' );
    }

    /**
     * Method returning related cup categories from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function cupCategory(){
        return $this->belongsTo( Cup_category::class, 'cup_category_id', 'cup_category_id' );
    }

    /**
     * Method returning related championship from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function championship(){
        return $this->belongsTo( Set::class, 'championship_id', 'championship_id' );
    }

}
