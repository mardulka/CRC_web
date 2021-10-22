<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Server_config extends Model{
    use HasFactory;


    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'server_config';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'server_config_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'server_config_id',
    ];

    /**
     * Method returning config type from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function configType(){
        return $this->belongsTo(Config_type::class, 'config_type_id', 'config_type_id');
    }


    /**
     * Method returning race from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function race(){
        return $this->belongsTo(Race::class, 'race_id', 'race_id');
    }




}
