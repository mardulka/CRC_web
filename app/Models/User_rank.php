<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_rank extends Model{
    use HasFactory, SoftDeletes;

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
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


    /**
     * Method returning related rank from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function rank(){
        return $this->belongsTo(Rank::class, 'rank_id', 'rank_id');
    }


}
