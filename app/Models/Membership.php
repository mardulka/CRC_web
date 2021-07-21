<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'membership';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'membership_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'owner' => false,
        'active' => true,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'rank_id',
    ];


    /**
     * Method returning related user from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function user(){
        return $this->belongsTo( User::class );
    }


    /**
     * Method returning related team from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function team(){
        return $this->belongsTo( Team::class );
    }


}
