<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = "applications";

    protected $fillable = [
        'agreement_no',
        'application_id',
        'first_agreement_date',
        'agreement_date',
        'expire_date',
        'allocation_status',
        'status',
        'save_status'
        
    ];
}
