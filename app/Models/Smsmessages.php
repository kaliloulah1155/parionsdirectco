<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Smsmessages extends Model
{
    public $timestamps = false;

    protected  $fillable =['emails','titre','contentssms','heures','dates'];
}
