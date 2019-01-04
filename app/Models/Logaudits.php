<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logaudits extends Model
{
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
     protected $guarded=[];
}
