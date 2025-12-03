<?php

namespace App\Models;

use App\Models\CRUD;

class UserBid extends CRUD
{
    protected $table = 'auction';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'auction_id', 'bid_amount', 'bid_date'];
}
