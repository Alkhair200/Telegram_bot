<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\States;
use App\Models\Local;
use App\Models\AdministrativUnit;

class Customers extends Model
{
    use HasFactory;
    protected $table = "customers";
    protected $guarded = [];

    public function getGender()
    {
        return $this->gender == 1 ? 'ذكر' : 'انثى';
    }

    public function administrative()
    {
        return $this->belongsTo(AdministrativUnit::class ,'administrative_unit_name' );
    }                                                       

    public function state()
    {
        return $this->belongsTo(States::class ,'state_name' );
    }

    public function local()
    {
        return $this->belongsTo(Local::class ,'local_name' );
    }
}
