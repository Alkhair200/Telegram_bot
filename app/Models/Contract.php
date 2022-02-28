<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ContractSubject;
use App\Models\CustomerTo;
use App\Models\Customers;
use App\Models\Witness;
use App\Models\User;

class Contract extends Model
{
    use HasFactory;

    protected $table = "contract";
    protected $guarded = [];


    public function ContractSubject()
    {
        return $this->belongsTo(ContractSubject::class , 'contract_subject');
    } 

    public function Customers()
    {
        return $this->belongsTo(Customers::class ,'first_side_no' );
    }

    public function CustomerTo()
    {
        return $this->belongsTo(CustomerTo::class ,'second_side_no' );
    }

    public function Witness()
    {
        return $this->belongsTo(Witness::class ,'first_witness_no' );
    }

    // public function WitnessTo()
    // {
    //     return $this->belongsTo(Witness::class ,'second_witness_no' );
    // }

    public function User()
    {
        return $this->belongsTo(User::class ,'user_no' );
    }
}
