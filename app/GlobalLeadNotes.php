<?php

namespace App;

use App\Lead;
use Illuminate\Database\Eloquent\Model;

class GlobalLeadNotes extends Model
{
    protected $guarded = [];

    public function lead(){
        return $this->belongsTo(Lead::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
