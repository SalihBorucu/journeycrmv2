<?php

namespace App;

use App\GlobalLeadNotes;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    //

    protected $guarded = [];

    public function leadAccounts(){
        return $this->hasMany(LeadAccount::class);
    }

    public function globalNotes(){
        return $this->hasOne(GlobalLeadNotes::class);
    }

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }


}
