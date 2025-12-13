<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\Auction;
use App\Models\Stamp;
use App\Models\Image;
use App\Models\Origin;
use App\Models\Color;
use App\Models\State;
use App\Models\UserBid;
use App\Models\User;

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

        $userBid = new UserBid;
        foreach ($auctionsSelect as $selected) {
            $bid_amount = $userBid->selectCol('bid_amount', 'auction_id', $selected['id']);
            if ($bid_amount) {
                $selectBid_amount[$selected['id']] =  $bid_amount['bid_amount'];
            } else {
                $selectBid_amount[$selected['id']] = 0;
            }
        }

        return View::render('auction/index', ['auctions' => $auctionsSelect, 'stamps' => $stampsSelect, 'images' => $selectImage, 'amounts' => $selectBid_amount]);
    }

    public function show($data)
    {
        $auction = new Auction;
        $auctionSelect = $auction->selectId($data['id']);

        $stamp = new Stamp;
        $stampSelect = $stamp->selectId($auctionSelect['stamp_id']);

        $image = new Image;
        $mainImage = $image->selectCol('main_image', 'stamp_id', $stampSelect['id']);

        $origin = new Origin;
        $originSelect = $origin->selectCol('pays', 'id', $stampSelect['origin_id']);

        $color = new Color;
        $colorSelect = $color->selectCol('color', 'id', $stampSelect['origin_id']);

        $state = new State;
        $stateSelect = $state->selectCol('state', 'id', $stampSelect['origin_id']);

        $userBid = new UserBid;
        $userBidSelect = $userBid->selectCol('bid_amount', 'auction_id', $auctionSelect['id']);

        return View::render('auction/show', [
            'auction' => $auctionSelect,
            'stamp' => $stampSelect,
            'image' => $mainImage,
            'origin' => $originSelect,
            'color' => $colorSelect,
            'state' => $stateSelect,
            'userBid' => $userBidSelect
        ]);
    }
}
