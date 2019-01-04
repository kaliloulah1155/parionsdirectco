<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use Webpatser\Uuid\Uuid;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $with = ['roles', 'permissions'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   public $timestamps = false;

    public function setCreatedAtAttribute($value) {
        $this->attributes['created_at'] = \Carbon\Carbon::now();
    }
    public function setUpdatedAtAttribute($value) {
        $this->attributes['updated_at'] = \Carbon\Carbon::now();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    protected $guarded = [];



    protected $casts=[
        'roles'=>'array'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static function boot(){
        parent::boot();
            self::creating(function ($model) {
                $model->uuid = (string) Uuid::generate(4);
            });
    }
    public function getRememberTokenName()
    {
        return '';
    }



}
