<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customers;
use App\Models\Work;

class Claimants extends Model
{
    use HasFactory;
    protected $table = "claimants_works";
    protected $guarded = [];

    public function customers()
    {
        return $this->belongsTo(Customers::class ,'customer_no' );
    }

    public function works()
    {
        return $this->belongsTo(Work::class ,'work_no' );
    }
}
