<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\Auction;
use App\Models\Stamp;
use App\Models\Image;


class AuctionController
{
    public function index()
    {

        $auction = new Auction;
        $auctionsSelect = $auction->select();

        $stamp = new Stamp;
        $stampsSelect = $stamp->select();

        $image = new Image;
        $selectImage = [];
        foreach ($stampsSelect as $selected) {
            $mainImage = $image->selectCol('main_image', 'stamp_id', $selected['id']);
            $selectImage[$selected['id']] =  $mainImage['main_image'];
        }
        return View::render('auction/index', ['auctions' => $auctionsSelect, 'stamps' => $stampsSelect, 'images' => $selectImage]);
    }
}
