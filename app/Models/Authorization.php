<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Witness;
use App\Models\Clients;
use App\Models\ClientsTo;
use App\Models\User;


class Authorization extends Model
{
    use HasFactory;

    protected $table = "authorization";
    protected $guarded = [];


    public function Clients()
    {
        return $this->belongsTo(Clients::class ,'client_name' );
    }

    public function ClientTo()
    {
        return $this->belongsTo(ClientsTo::class ,'clientTo_name' );
    }

    public function Witness()
    {
        return $this->belongsTo(Witness::class ,'first_witness_no' );
    }

    public function User()
    {
        return $this->belongsTo(User::class ,'user_no' );
    }

    

}
