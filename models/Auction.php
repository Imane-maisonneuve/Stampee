<?php

namespace App\Models;

use App\Models\CRUD;

class Auction extends CRUD
{
    protected $table = 'auction';
    protected $primaryKey = 'id';
    protected $fillable = ['date_start', 'date_end', 'price_floor', 'is_lord_s_favorite', 'stamp_id'];
}
