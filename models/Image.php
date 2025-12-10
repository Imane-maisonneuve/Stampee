<?php

namespace App\Models;

use App\Models\CRUD;

class Image extends CRUD
{
    protected $table = 'image';
    protected $primaryKey = 'id';
    protected $fillable = ['main_image', 'additional_image_folder', 'stamp_id'];
}
