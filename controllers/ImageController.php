<?php

namespace App\Controllers;

use App\Providers\View;

use App\Models\Image;
use App\Models\User;
use App\Models\Stamp;
use App\Providers\Validator;
use App\Providers\Auth;

class ImageController
{

    public function create($data)
    {
        return View::render('image/create', ['stamp' => $data]);
    }

    public function store($data)
    {
        Auth::session();


        $dir = "public/img/";
        $mainImage = $_FILES['main_image']['name'];
        $mainImageTmp = $_FILES['main_image']['tmp_name'];
        $typeFileMainImage = explode(".", $mainImage)[1];

        $additionalImage = $_FILES['additional_image']['name'];
        $additionalImageTmp = $_FILES['additional_image']['tmp_name'];
        $typeFileAdditionalImage = explode(".", $additionalImage)[1];


        $validator = new Validator;
        $validator->field('main_image', $_FILES['main_image'])->required()->typeFile($typeFileMainImage);
        $validator->field('additional_image', $_FILES['additional_image'])->typeFile($typeFileAdditionalImage);

        if ($validator->isSuccess()) {
            $destinationMain = $dir . $mainImage;
            $destinationAdd = $dir . $additionalImage;
            if ((move_uploaded_file($mainImageTmp, $destinationMain)) && (move_uploaded_file($additionalImageTmp, $destinationAdd))) {
                $image = new Image;
                $insert = $image->insert(['main_image' => $_FILES['main_image']['name'], 'additional_image' => $_FILES['additional_image']['name'], 'stamp_id' => $data['stamp_id']]);
                if ($insert) {
                    $user = new User;
                    $selectId = $user->selectId($_SESSION['user_id']);

                    $stamp = new Stamp;
                    $selectStamps = $stamp->selectListe('user_id', $selectId['id']);
                    if ($selectStamps) {
                        $image = new Image;
                        foreach ($selectStamps as $selected) {
                            $mainImage = $image->selectCol('main_image', 'stamp_id', $selected['id']);
                            $selectImage[$selected['id']] =  $mainImage['main_image'];
                        }
                        if ($selectImage) {
                            return View::render('user/show', ['user' => $selectId, 'stamps' => $selectStamps, 'images' => $selectImage]);
                        } else {
                            return View::render('user/show', ['user' => $selectId, 'stamps' => $selectStamps]);
                        }
                    } else {
                        return View::render('user/show', ['user' => $selectId]);
                    }
                } else {
                    return view::render('error');
                }
            }
        } else {
            $errors = $validator->getErrors();
            return view::render('image/create', ['errors' => $errors, 'stamp' => $data]);
        }

        // $validator = new Validator;
        // $validator->field('name', $data['name'])->required()->min(10)->max(100);
        // $validator->field('certified', $data['certified'])->required();
        // $validator->field('print_run', $data['print_run'])->required();
        // $validator->field('height', $data['height'])->required();
        // $validator->field('width', $data['width'])->required();
        // $validator->field('origin_id', $data['origin_id'])->required();
        // $validator->field('color_id', $data['color_id'])->required();
        // $validator->field('state_id', $data['state_id'])->required();

        // if ($validator->isSuccess()) {
        //     $image = new Image;

        //     $insert = $image->insert($data);
        //     if ($insert) {
        //         $user = new User;
        //         $selectId = $user->selectId($_SESSION['user_id']);

        //         $stamp = new Stamp;
        //         $selectStamps = $stamp->selectListe('user_id', $selectId['id']);
        //         if ($selectStamps) {
        //             $image = new Image;
        //             foreach ($selectStamps as $selected) {
        //                 $mainImage = $image->selectCol('main_image', 'stamp_id', $selected['id']);
        //                 $selectImage[$selected['id']] =  $mainImage['main_image'];
        //             }
        //             if ($selectImage) {
        //                 return View::render('user/show', ['user' => $selectId, 'stamps' => $selectStamps, 'images' => $selectImage]);
        //             } else {
        //                 return View::render('user/show', ['user' => $selectId, 'stamps' => $selectStamps]);
        //             }
        //         } else {
        //             return View::render('user/show', ['user' => $selectId]);
        //         }
        //     } else {
        //         return view::render('error');
        //     }
        // } else {
        //     $errors = $validator->getErrors();
        //     return view::render('image/create', ['errors' => $errors, 'stamp' => $data]);
        // }

    }
}
