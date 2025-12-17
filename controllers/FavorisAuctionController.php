<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\FavorisAuction;
use App\Providers\Auth;


class FavorisAuctionController
{
    public function store($data)
    {

        if (Auth::session()) {

            $auctionFavoris = new FavorisAuction;

            $selectFavoris =  $auctionFavoris->selectByCompositeKey();

            $exists = false;
            var_dump($selectFavoris);
            foreach ($selectFavoris as $favori) {
                if (
                    $favori['user_id'] == $data['user_id'] &&
                    $favori['auction_id'] == $data['auction_id']
                ) {
                    $exists = true;
                    break;
                }
            }
            if ($exists == false) {
                $insertauctionFavoris = $auctionFavoris->insert($data);
            }

            return View::redirect('');
        }
    }
}
