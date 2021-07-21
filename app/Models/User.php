<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{
    use HasFactory, Notifiable, softDeletes;

    /**
     * Table connected with this model
     *
     * @var string
     */
    protected $table = 'user';


    /**
     * Primary key of this table
     *
     * @var string
     */
    protected $primaryKey = 'user_id';


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
        'user_id',
        'remember_token',
        'email_verified_at',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Method returning roles from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function roles(){
        return $this->BelongsToMany( Role::class, 'role_user')->using( User_role::class )->withTimestamps();
    }


    /**
     * Method returning crews from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function crews(){
        return $this->BelongsToMany( Crew::class, 'user_crew')->withTimestamps();
    }


    /**
     * Method returning crews from ManyToMany relation with immediate table.
     *
     * @return BelongsToMany
     */
    public function organizers(){
        return $this->BelongsToMany( Championship::class, 'organizing')->withTimestamps();
    }


    /**
     * Method returning related country from OneToMany relation.
     *
     * @return BelongsTo
     */
    public function country(){
        return $this->belongsTo( Country::class );
    }


    /**
     * Method returning all user_ranks from One ToMany relation.
     *
     * @return HasMany
     */
    public function user_ranks(){
        return $this->hasMany(User_rank::class);
    }


    /**
     * Method returning all liveries from One ToMany relation.
     *
     * @return HasMany
     */
    public function liveries(){
        return $this->hasMany(Livery::class);
    }


    /**
     * Method returning all memberships from One ToMany relation.
     *
     * @return HasMany
     */
    public function memberships(){
        return $this->hasMany(Membership::class);
    }


}
