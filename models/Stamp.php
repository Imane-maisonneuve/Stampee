<?php

namespace App\Models;

use App\Models\CRUD;

class Stamp extends CRUD
{
    protected $table = 'stamp';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'year_creation', 'certified', 'print_run', 'height', 'width', 'origin_id', 'color_id', 'user_id', 'state_id'];
}
