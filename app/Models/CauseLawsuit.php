<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauseLawsuit extends Model
{
    use HasFactory;

    protected $table = "lawsuit";
    protected $guarded = [];
}
