<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crew extends Model{
    use HasFactory, softDeletes;



    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'crew';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'crew_id';


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
        'crew_id',
    ];


    /**
     * Method returning users from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function users(){
        return $this->BelongsToMany( User::class, 'user_crew')->withTimestamps();
    }


}
