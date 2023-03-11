<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upozilla extends Model
{
    use HasFactory;

    protected $table = "upozillas";
    protected $fillable = [
        'division_id',
        'district_id',
        'name',
        'code'
    ];
}
