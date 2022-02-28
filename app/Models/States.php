<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    use HasFactory;

    protected $table = "states";
    protected $fillable = [
        // 'state_no',
        'state_name',
        'command',
    ];
}
