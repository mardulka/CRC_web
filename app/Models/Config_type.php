<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config_type extends Model{
    use HasFactory, SoftDeletes;

    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'config_type';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'config_type_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'config_type_id',
    ];


    /**
     * Method returning all server configs from One ToMany relation.
     *
     * @return HasMany
     */
    public function serverConfigs(){
        return $this->hasMany(Server_config::class, 'config_type_id', 'config_type_id');
    }

}
