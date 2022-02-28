<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\States;
use App\Models\Local;
use App\Models\Customers;

class AdministrativUnit extends Model
{
    use HasFactory;

    protected $table = "administrative_unit";
    protected $guarded = [];

    public function state()
    {
        return $this->belongsTo(States::class ,'state_no' );
    }

    public function local()
    {
        return $this->belongsTo(Local::class ,'local_name' );
    }
                                                     
}
