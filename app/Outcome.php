<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
        public function getNameAttribute($value)
    {
        return ucwords(preg_replace('/([_]+)/', ' ', $value));
    }
}
