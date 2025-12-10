<?php

namespace App\Models;

use App\Models\CRUD;

class UserBid extends CRUD
{
    protected $table = 'user_bid';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'auction_id', 'bid_amount', 'bid_date'];
}
