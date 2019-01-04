<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    public function setCreatedAtAttribute($value) {
        $this->attributes['created_at'] = \Carbon\Carbon::now();
    }
    public function setUpdatedAtAttribute($value) {
        $this->attributes['updated_at'] = \Carbon\Carbon::now();
    }

   protected  $fillable =['name','departement','responsable','created_at','updated_at','guard_name'];
}
