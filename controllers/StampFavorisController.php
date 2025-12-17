<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\StampFavoris;
use App\Providers\Auth;


class StampFavorisController
{
    public function store($data)
    {
        if (Auth::session()) {

            $stampFavoris = new StampFavoris;
            $insertStampFavoris = $stampFavoris->insert($data);

            if ($insertStampFavoris) {
                return View::redirect('user/show', ['id' => $_SESSION['user_id']]);
            } else {
                return View::render('error', ['msg' => 'Echec de l"insertion dans favoris!']);
            }
        }
    }
}
