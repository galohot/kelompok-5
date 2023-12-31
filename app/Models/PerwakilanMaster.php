<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerwakilanMaster extends Model
{
    use HasFactory;

    protected $table = 'perwakilan_master';

    protected $fillable = ['Country','Office', 'Region', 'CountryCode'];
}