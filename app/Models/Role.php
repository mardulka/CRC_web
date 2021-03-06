<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Role extends Model{
    use HasFactory, softDeletes;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'role';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'role_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'role_id',
    ];


    /**
     * Method returning users from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function users(){
        return $this->BelongsToMany( User::class, 'user_role', 'role_id', 'user_id', 'role_id', 'user_id')->withTimestamps();
    }


}
