<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\Auction;
use App\Models\Stamp;


class AuctionController
{
    public function index()
    {

        $auction = new Auction;
        $auctionsSelect = $auction->select();

        $stamp = new Stamp;
        $stampsSelect = $stamp->select();
        return View::render('auction/index');
    }
}
