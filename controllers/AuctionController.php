<?php

namespace App\Controllers;

use App\Providers\View;


class AuctionController
{
    public function index()
    {
        return View::render("auction/index");
    }
}
