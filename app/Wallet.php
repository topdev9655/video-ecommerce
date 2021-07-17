<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'points', 'wallet', 'last_claim', 'last_point_claim'];
}
