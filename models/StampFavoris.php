<?php

namespace App\Models;

use App\Models\CRUD;

class StampFavoris extends CRUD
{
    protected $table = 'stamp_favoris';
    protected $primaryKey = ['user_id', 'stamp_id'];
    protected $fillable = ['user_id', 'stamp_id'];
}
