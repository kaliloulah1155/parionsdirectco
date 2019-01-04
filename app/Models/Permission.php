<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;

    public function setCreatedAtAttribute($value) {
        $this->attributes['created_at'] = \Carbon\Carbon::now();
    }
    public function setUpdatedAtAttribute($value) {
        $this->attributes['updated_at'] = \Carbon\Carbon::now();
    }

    protected $guarded = [];

    public function profiles(){

        return $this->belongsToMany(Profiles::class);
    }

}
