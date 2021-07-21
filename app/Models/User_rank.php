<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_rank extends Model{
    use HasFactory, softDeletes;

    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'user_rank';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'user_rank_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'user_rank_id',
    ];


    /**
     * Method returning related user from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function users(){
        return $this->belongsTo(User::class);
    }


    /**
     * Method returning related rank from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function ranks(){
        return $this->belongsTo(User::class);
    }


}