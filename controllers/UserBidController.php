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
use App\Providers\Auth;
use App\Providers\Validator;


class UserBidController
{
    public function store($data)
    {
        Auth::session();

        $auction = new Auction;
        $auctionSelect = $auction->selectId($data['auction_id']);

        $userBid = new UserBid;
        $maxAmount = $userBid->max('bid_amount', 'auction_id', $data['auction_id']);

        $validator = new Validator;

        if (isset($maxAmount['MAX(bid_amount)']) && $maxAmount['MAX(bid_amount)'] !== null) {
            $validator->field('bid_amount', $data['bid_amount'])->required()->bigger($maxAmount['MAX(bid_amount)']);
        } else {
            $validator->field('bid_amount', $data['bid_amount'])->required()->bigger($auctionSelect['price_floor']);
        }

        if ($validator->isSuccess()) {
            var_dump($data);
            $insert = $userBid->insert($data);
            if ($insert) {
                return View::redirect('auction/show', ['id' => $data['auction_id']]);
            } else {
                return view::render('error');
            }
        } else {
            $errors = $validator->getErrors();

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

            $user = new User;
            $historiqueBids = $userBid->selectListe('auction_id', $data['auction_id']);

            $historiqueUsers = [];

            if ($historiqueBids) {
                foreach ($historiqueBids as $selected) {
                    $userSelect = $user->selectId($selected['user_id']);
                    $historiqueUsers[$selected['user_id']] =  mb_substr($userSelect['surname'], 0, 1) . '.' . $userSelect['name'];
                }
            }

            return View::render('auction/show', [
                'errors' => $errors,
                'auction' => $auctionSelect,
                'stamp' => $stampSelect,
                'image' => $mainImage,
                'origin' => $originSelect,
                'color' => $colorSelect,
                'state' => $stateSelect,
                'userBid' => $userBidSelect,
                'historiqueBids' => $historiqueBids,
                'historiqueUsers' => $historiqueUsers
            ]);
        }
    }
}
