<?php

namespace App\Controllers;

use App\Providers\View;

use App\Models\Image;
use App\Models\User;
use App\Models\Stamp;
use App\Providers\Validator;
use App\Providers\Auth;
use App\Models\Auction;

class ImageController
{

    public function create($data)
    {
        return View::render('image/create', ['stamp' => $data]);
    }

    public function store($data)
    {
        Auth::session();
        $dir = 'public/img/';
        $mainImage = $_FILES['main_image']['name'];
        $mainImageTmp = $_FILES['main_image']['tmp_name'];

        $additionalImage = $_FILES['additional_image']['name'];
        $additionalImageTmp = $_FILES['additional_image']['tmp_name'];

        if ($_FILES['main_image']['name'] != '') {
            $typeFileMainImage = explode(".", $mainImage)[1];
        }

        $validator = new Validator;
        $validator->field('main_image', $_FILES['main_image'])->required()->typeFile($typeFileMainImage);

        if (($_FILES['additional_image']['name'] != '')) {
            $typeFileAdditionalImage = explode(".", $additionalImage)[1];
            $validator->field('additional_image', $_FILES['additional_image'])->typeFile($typeFileAdditionalImage);
        }

        if ($validator->isSuccess()) {

            $destinationMain = $dir . $mainImage;
            $destinationAdd = $dir . $additionalImage;
            if (move_uploaded_file($mainImageTmp, $destinationMain)) {

                $imageAddinsert = '';
                if (move_uploaded_file($additionalImageTmp, $destinationAdd)) {
                    $imageAddinsert = $additionalImage;
                }

                $image = new Image;
                $insert = $image->insert(['main_image' => $mainImage, 'additional_image' => $imageAddinsert, 'stamp_id' => $data['stamp_id']]);

                if ($insert) {
                    $user = new User;
                    $selectId = $user->selectId($_SESSION['user_id']);

                    $stamp = new Stamp;
                    $selectStamps = $stamp->selectListe('user_id', $selectId['id']);
                    if ($selectStamps) {
                        $image = new Image;
                        foreach ($selectStamps as $selected) {
                            $mainImage = $image->selectCol('main_image', 'stamp_id', $selected['id']);
                            // Stocker les images dans un tableau associatif avec l'ID du timbre comme clé
                            $selectImage[$selected['id']] =  $mainImage['main_image'];
                            // Vérifier si le timbre est en enchère
                            $auction = new Auction;
                            $isAuction = [];
                            $auctionselect = $auction->selectCol('stamp_id', 'stamp_id', $selected['id']);
                            if ($auctionselect) {
                                // Marquer le timbre comme étant en enchère dans un tableau ayant comme index l'ID du timbre
                                $isAuction[$selected['id']] = 1;
                            }
                        }
                        if ($selectImage) {
                            return View::render('user/show', ['user' => $selectId, 'stamps' => $selectStamps, 'images' => $selectImage, 'isAuction' => $isAuction]);
                        }
                        // TODO:gerer autrement
                        else {
                            return View::render('user/show', ['user' => $selectId, 'stamps' => $selectStamps]);
                        }
                    } else {
                        return View::render('user/show', ['user' => $selectId]);
                    }
                } else {
                    $errors = $validator->getErrors();
                    return view::render('image/create', ['errors' => $errors, 'stamp_id' => $data['stamp_id']]);
                }
            } else {
                $errors = $validator->getErrors();
                return view::render('image/create', ['errors' => $errors, 'stamp_id' => $data['stamp_id']]);
            }
        } else {
            $errors = $validator->getErrors();
            return view::render('image/create', ['errors' => $errors, 'stamp_id' => $data['stamp_id']]);
        }
    }


    public function edit($data = [])
    {
        Auth::session();
        if (isset($data['stamp_id']) && $data['stamp_id'] != null) {

            $image = new Image;
            $imageMain = $image->selectCol('main_image', 'stamp_id', $data['stamp_id']);

            $imageAdd = $image->selectCol('additional_image', 'stamp_id', $data['stamp_id']);
            $selectImage = ['main_image' => $imageMain['main_image'], 'additional_image' => $imageAdd['additional_image']];

            return View::render('image/edit', ['stamp_id' => $data['stamp_id'], 'image' => $selectImage]);
        } else {
            return View::render('error', ['msg' => 'Identifiant de stamp manquant ou invalide!']);
        }
    }

    public function update($data, $get = [])
    {
        Auth::session();

        $image = new Image;
        $imageSelect = $image->selectListe('stamp_id', $data['stamp_id'])[0];

        $dir = 'public/img/';

        $validator = new Validator;

        if ($_FILES['main_image']['name'] != '') {
            $mainImage = $_FILES['main_image']['name'];
            $mainImageTmp = $_FILES['main_image']['tmp_name'];
            $typeFileMainImage = explode(".", $mainImage)[1];
            $validator->field('main_image', $_FILES['main_image'])->required()->typeFile($typeFileMainImage);

            if ($validator->isSuccess()) {
                $destinationMain = $dir . $mainImage;
                if (move_uploaded_file($mainImageTmp, $destinationMain)) {
                    $update = $image->update(['main_image' => $mainImage, 'additional_image' => $imageSelect['additional_image'], 'stamp_id' => $imageSelect['stamp_id']], $imageSelect['id']);
                }
            } else {
                $errors = $validator->getErrors();
                return view::render('image/edit', ['errors' => $errors, 'stamp_id' => $data['stamp_id']]);
            }
        }
        if (($_FILES['additional_image']['name'] != '')) {
            $additionalImage = $_FILES['additional_image']['name'];
            $additionalImageTmp = $_FILES['additional_image']['tmp_name'];
            $typeFileAdditionalImage = explode(".", $additionalImage)[1];
            $validator->field('additional_image', $_FILES['additional_image'])->typeFile($typeFileAdditionalImage);
            if ($validator->isSuccess()) {
                $destinationAdd = $dir . $additionalImage;
                if (move_uploaded_file($additionalImageTmp, $destinationAdd)) {
                    $update = $image->update(['main_image' => $imageSelect['main_image'], 'additional_image' => $additionalImage, 'stamp_id' => $imageSelect['stamp_id']], $imageSelect['id']);
                }
            } else {
                $errors = $validator->getErrors();
                return view::render('image/edit', ['errors' => $errors, 'stamp_id' => $data['stamp_id']]);
            }
        }

        $user = new User;
        $selectId = $user->selectId($_SESSION['user_id']);

        $stamp = new Stamp;

        $selectStamps = $stamp->selectListe('user_id', $selectId['id']);

        if ($selectStamps) {
            $image = new Image;
            foreach ($selectStamps as $selected) {
                $mainImage = $image->selectCol('main_image', 'stamp_id', $selected['id']);
                // Stocker les images dans un tableau associatif avec l'ID du timbre comme clé
                $selectImage[$selected['id']] =  $mainImage['main_image'];
                // Vérifier si le timbre est en enchère
                $auction = new Auction;
                $isAuction = [];
                $auctionselect = $auction->selectCol('stamp_id', 'stamp_id', $selected['id']);
                if ($auctionselect) {
                    // Marquer le timbre comme étant en enchère dans un tableau ayant comme index l'ID du timbre
                    $isAuction[$selected['id']] = 1;
                }
            }
            if ($selectImage) {
                return View::render('user/show', ['user' => $selectId, 'stamps' => $selectStamps, 'images' => $selectImage, 'isAuction' => $isAuction]);
            }
            // TODO:gerer autrement
            else {
                return View::render('user/show', ['user' => $selectId, 'stamps' => $selectStamps]);
            }
        } else {
            return View::render('user/show', ['user' => $selectId]);
        }
    }
}
