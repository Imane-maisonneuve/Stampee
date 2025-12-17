<?php

namespace App\Models;

use App\Models\CRUD;

class FavorisAuction extends CRUD
{
    protected $table = 'favoris_auction';
    protected $primaryKey = ['user_id', 'auction_id'];
    protected $fillable = ['user_id', 'auction_id'];
}
