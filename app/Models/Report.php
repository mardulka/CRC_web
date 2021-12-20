<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model{
    use HasFactory, SoftDeletes;

    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'report';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'report_id';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'report_id',
    ];


    /**
     * Method returning related rec from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function race() {
        return $this->belongsTo( Race::class, 'race_id', 'race_id');
    }


    /**
     * Method returning user which created a report.
     *
     * @return BelongsTo
     */
    public function reported_by(){
        return $this->belongsTo( Participation::class, 'reported_by_id', 'participation_id');
    }


    /**
     * Method returning user which was report.
     *
     * @return BelongsTo
     */
    public function reported_driver(){
        return $this->belongsTo( Participation::class, 'reported_driver_id', 'participation_id');
    }


}
