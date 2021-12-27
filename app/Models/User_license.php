<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_license extends Model{
    use HasFactory, SoftDeletes;

    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'user_license';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'user_license_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'user_license_id',
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
    public function license(){
        return $this->belongsTo(License::class, 'license_id', 'license_id');
    }


}
