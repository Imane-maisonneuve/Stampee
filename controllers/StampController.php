<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\User;
use App\Models\Origin;
use App\Models\Image;
use App\Models\State;
use App\Models\Color;
use App\Models\Stamp;
use App\Providers\Validator;
use App\Providers\Auth;

class StampController
{
    public function create()
    {
        $color = new Color;
        $colorSelect = $color->select();

        $origin = new Origin;
        $originSelect = $origin->select();

        $state = new State;
        $stateSelect = $state->select();

        return View::render('stamp/create', ['colors' => $colorSelect,  'origins' => $originSelect, 'states' => $stateSelect]);
    }

    public function store($data)
    {
        Auth::session();
        $validator = new Validator;
        $validator->field('name', $data['name'])->required()->min(10)->max(100);
        $validator->field('certified', $data['certified'])->required();
        $validator->field('print_run', $data['print_run'])->required();
        $validator->field('height', $data['height'])->required();
        $validator->field('width', $data['width'])->required();
        $validator->field('origin_id', $data['origin_id'])->required();
        $validator->field('color_id', $data['color_id'])->required();
        $validator->field('state_id', $data['state_id'])->required();

        if ($validator->isSuccess()) {
            $stamp = new Stamp;

            $insert = $stamp->insert($data);
            if ($insert) {
                // $user = new User;
                // $selectId = $user->selectId($_SESSION['user_id']);

                // $stamp = new Stamp;
                // $selectStamps = $stamp->selectListe('user_id', $selectId['id']);
                // if ($selectStamps) {
                //     $image = new Image;
                //     foreach ($selectStamps as $selected) {
                //         $mainImage = $image->selectCol('main_image', 'stamp_id', $selected['id']);
                //         $selectImage[$selected['id']] =  $mainImage['main_image'];
                //     }
                //     if ($selectImage) {
                //         return View::render('user/show', ['user' => $selectId, 'stamps' => $selectStamps, 'images' => $selectImage]);
                //     } else {
                //         return View::render('user/show', ['user' => $selectId, 'stamps' => $selectStamps]);
                //     }
                // } else {
                //     return View::render('user/show', ['user' => $selectId]);
                // }

                return View::render('image/create', ['stamp_id' => $insert]);
            } else {
                return view::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            $color = new Color;
            $colorSelect = $color->select();

            $origin = new Origin;
            $originSelect = $origin->select();

            $state = new State;
            $stateSelect = $state->select();
            return view::render('stamp/create', ['errors' => $errors, 'stamp' => $data, 'colors' => $colorSelect,  'origins' => $originSelect, 'states' => $stateSelect]);
        }
    }
}
