<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\States;

class Local extends Model
{
    use HasFactory;

    protected $table = "local";
    protected $fillable = [
        // 'local_no',
        'state_no',
        'local_name',
        'command',
    ];

    public function state()
    {
        return $this->belongsTo(States::class ,'state_no');
    }
}
