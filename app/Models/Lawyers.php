<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyers extends Model
{
    use HasFactory;
    protected $table = "lawyers";
    protected $guarded = [];


    public function getGender()
    {
        return $this->gender == 1 ? 'ذكر' : 'انثى';
    }
}
