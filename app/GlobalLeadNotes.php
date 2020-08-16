<?php

namespace App;

use App\Lead;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class GlobalLeadNotes extends Model
{
    protected $guarded = [];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function lead(){
        return $this->belongsTo(Lead::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
