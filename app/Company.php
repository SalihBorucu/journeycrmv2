<?php

namespace App;

use App\Lead;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function leads(){
        return $this->hasMany(Lead::class);
    }
}
