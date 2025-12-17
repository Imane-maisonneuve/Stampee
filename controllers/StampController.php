<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\User;
use App\Models\Origin;
use App\Models\Image;
use App\Models\State;
use App\Models\Color;
use App\Models\Stamp;
use App\Models\StampFavoris;
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
        $validator->field('year_creation', $data['year_creation'])->required()->min(4)->max(4);
        $validator->field('certified', $data['certified'])->required();
        $validator->field('print_run', $data['print_run'])->required()->int();
        $validator->field('height', $data['height'])->required()->int();
        $validator->field('width', $data['width'])->required()->int();
        $validator->field('origin_id', $data['origin_id'])->required();
        $validator->field('color_id', $data['color_id'])->required();
        $validator->field('state_id', $data['state_id'])->required();

        if ($validator->isSuccess()) {
            $stamp = new Stamp;

            $insert = $stamp->insert($data);
            if ($insert) {
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

    public function edit($data = [])
    {
        Auth::session();
        if (isset($data['id']) && $data['id'] != null) {
            $stamp = new Stamp;
            $selectId = $stamp->selectId($data['id']);

            if ($selectId) {
                $color = new Color;
                $colorSelect = $color->select();

                $origin = new Origin;
                $originSelect = $origin->select();

                $state = new State;
                $stateSelect = $state->select();

                return View::render("stamp/edit", ['stamp' => $selectId, 'colors' => $colorSelect, 'origins' => $originSelect, 'states' => $stateSelect]);
            }
        } else {
            return View::render('error', ['msg' => 'Identifiant de stamp manquant ou invalide!']);
        }
    }

    public function update($data, $get = [])
    {
        Auth::session();
        $validator = new Validator;
        $validator->field('name', $data['name'])->required()->min(10)->max(100);
        $validator->field('certified', $data['certified'])->required();
        $validator->field('print_run', $data['print_run'])->required()->int();
        $validator->field('height', $data['height'])->required()->int();
        $validator->field('width', $data['width'])->required()->int();
        $validator->field('origin_id', $data['origin_id'])->required();
        $validator->field('color_id', $data['color_id'])->required();
        $validator->field('state_id', $data['state_id'])->required();

        if ($validator->isSuccess()) {
            $stamp = new Stamp;
            $update = $stamp->update($data, $get['id']);
            if ($update) {
                return View::redirect('image/edit', ['stamp_id' => $get['id']]);
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

    public function delete($data)
    {
        if (Auth::session()) {

            $image = new Image;
            $imageSelect = $image->selectListe('stamp_id', $data['stamp_id'])[0];
            $deleteImage = $image->delete($imageSelect['id']);

            $stamp = new Stamp;
            $deleteStamp = $stamp->delete($data['stamp_id']);

            if ($deleteImage && $deleteStamp) {
                return View::redirect('user/show', ['id' => $_SESSION['user_id']]);
            } else {
                return View::render('error', ['msg' => 'Echec de la suppression!']);
            }
        }
    }
}
