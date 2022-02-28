<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customers;
use App\Models\SubjectConsult;
use App\Models\User;

class Consults extends Model
{
    use HasFactory;


    protected $table = "consults";
    protected $guarded = [];


    public function Customers()
    {
        return $this->belongsTo(Customers::class ,'customer_name' );
    }  

    public function SubjectConsult()
    {
        return $this->belongsTo(SubjectConsult::class ,'consult_subject_no' );
    } 

    public function User()
    {
        return $this->belongsTo(User::class ,'user_no' );
    } 
    
}
