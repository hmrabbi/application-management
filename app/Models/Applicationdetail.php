<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicationdetail extends Model
{
    use HasFactory;

    protected $table = "applicationdetails";

    protected $fillable = [
        'application_id',
        'application_name',
        'father_name',
        'mother_name',
        'mobile_number',
        'division_id',
        'district_id',
        'upozilla_id',
        'gender_id'
    ];
}
