<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Sessions;
use App\Models\Prosecution;
use App\Models\Witness;
use App\Models\User;

class sessionWitness extends Model
{
    use HasFactory;

    protected $table = "sessions_witness";
    protected $guarded = [];

    public function Sessions()
    {
        return $this->belongsTo(Sessions::class ,'id' );
    }

    public function Prosecution()
    {
        return $this->belongsTo(Prosecution::class ,'prose_date' );
    }

    public function Witness()
    {
        return $this->belongsTo(Witness::class ,'witness_name' );
    }

    public function User()
    {
        return $this->belongsTo(User::class ,'user_no' );
    }

    public function get()
    {
        return $this->witch_witness == 1 ? 'شاهد المدعى' : 'شاهد المدعى عليه';
    }
}
