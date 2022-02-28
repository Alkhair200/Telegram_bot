<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Prosecution;
use App\Models\Courts;
use App\Models\Lawyers;
use App\Models\Judgess;

class Sessions extends Model
{
    use HasFactory;

    protected $table = "sessions";
    protected $guarded = [];


    public function Prosecutions()
    {
        return $this->belongsTo(Prosecution::class ,'prose_date' );
    }

    public function Courts()
    {
        return $this->belongsTo(Courts::class ,'court_name' );
    }

    public function Lawyers()
    {
        return $this->belongsTo(Lawyers::class ,'lawyer_name' );
    }

    public function Judge()
    {
        return $this->belongsTo(Judges::class ,'judge_name' );
    }

    public function User()
    {
        return $this->belongsTo(User::class ,'user_no' );
    }

    function endDecision()
{
    if ($this->end_decision == 1) {

        return "نهائي";

    } elseif ($this->end_decision == 2) {
       
        return "لا";
    }
} // end of getBuType
}
