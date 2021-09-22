<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Set extends Model{
    use HasFactory, SoftDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'set';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'set_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'set_id',
    ];


    /**
     * Method returning related championship from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function championship() {
        return $this->belongsTo( Championship::class, 'championship_id', 'championship_id');
    }


    /**
     * Method returning related car categories from ManyToMany relation.
     *
     * @return BelongsToMany
     */
    public function carCategories() {
        return $this->belongsToMany( Car_category::class,  'car_category_set')->withTimestamps();
    }


    /**
     * Method returning all related applications from OneToMany relation.
     *
     * @return HasMany
     */
    public function applications(){
        return $this->hasMany( Application::class, 'set_id', 'set_id');
    }


    /**
     * Method returning all related races from OneToMany relation.
     *
     * @return HasMany
     */
    public function races(){
        return $this->hasMany( Race::class, 'set_id', 'set_id');
    }


}
