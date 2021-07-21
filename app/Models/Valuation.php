<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Valuation extends Model{
    use HasFactory;




    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'valuation';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'valuation_id';


    /**
     * Default attributes values
     *
     * @var bool[]
     */
    protected $attributes = [
        'points' => 0,
        'locked' => false,
    ];


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'valuation_id',
    ];


    /**
     * Method returning point table from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function pointTable(){
        return $this->belongsTo(Point_table::class);
    }




}
