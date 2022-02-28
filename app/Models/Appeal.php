<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prosecution;

class Appeal extends Model
{
    use HasFactory;
    protected $table = "appeal";
    protected $guarded = [];

    public function Prosecution()
    {
        return $this->belongsTo(Prosecution::class ,'prosecution_date' );
    }
}
