<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customers;
use App\Models\CustomerTo;
use App\Models\ProseText;
use App\Models\CauseLawsuit;
use App\Models\User;

class Prosecution extends Model
{
    use HasFactory;

    protected $table = "prosecution";
    protected $guarded = [];

    public function Customer()
    {
        return $this->belongsTo(Customers::class ,'customer_name' );
    }

    public function CustomerTo()
    {
        return $this->belongsTo(CustomerTo::class ,'customerTo_name' );
    }

    public function ProseText()
    {
        return $this->belongsTo(ProseText::class ,'prose_text_name' );
    }

    public function CauseLawsuit()
    {
        return $this->belongsTo(CauseLawsuit::class ,'cause_lawsuit_name' );
    }

    public function User()
    {
        return $this->belongsTo(User::class ,'user_no' );
    }

    public function proseType()
    {

        if ($this->prose_type == 1) {

            return $this->prose_type = 'جنائية';
            
        } elseif ($this->prose_type == 2) {

            return $this->prose_type = 'مدنية';

        }elseif ($this->prose_type == 3) {

            return $this->prose_type = 'شرعية';

        }elseif ($this->prose_type = 4) {

            return $this->prose_type = 'إدارية';
        }
        
    }

    
}
