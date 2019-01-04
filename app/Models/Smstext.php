<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Smstext extends Model
{
    public $timestamps = false;

    protected  $fillable =['telephone','titre','smscontents','heures','dates'];
}
