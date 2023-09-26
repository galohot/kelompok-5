<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorldBankTrade extends Model
{
    use HasFactory;
    protected $table = 'world_bank_country_trade';
}
