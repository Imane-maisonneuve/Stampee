<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\User;
use App\Models\Auction;
use App\Models\Origin;
use App\Models\State;
use App\Models\Color;
use App\Providers\Validator;
use App\Providers\Auth;

class StampController
{
    public function show($data = [])
    {
        Auth::session();
        if (isset($data['id']) && $data['id'] != null && ($_SESSION['user_id'] == $data['id'])) {

            $user = new User;
            $selectId = $user->selectId($data['id']);

            if ($selectId) {
                $auction = new Auction;
                $selectAuctions = $auction->getAuctions($data['id']);
                if ($selectAuctions) {
                    return View::render('user/show', ['user' => $selectId, 'auctions' => $selectAuctions]);
                } else {
                    return View::render('user/show', ['user' => $selectId]);
                }
            } else {
                $errors = ['msg' => 'Echec d’authentification!'];
                return view::render('auth/create', ['errors' => $errors]);
            }
        } else {
            return view::redirect('login');
        }
    }

    public function create()
    {
        return View::render('user/create');
    }

    public function store($data)
    {
        Auth::session();
        $validator = new Validator;
        $validator->field('name', $data['name'])->required()->min(2)->max(50);
        $validator->field('surname', $data['surname'])->required()->min(2)->max(50);
        $validator->field('phone', $data['phone'])->min(7)->max(20);
        $validator->field('email', $data['email'])->required()->max(50)->email()->unique('User');
        $validator->field('password', $data['password'])->required()->min(6)->max(20);
        $validator->field('adress', $data['adress'])->required()->min(10)->max(50);
        $validator->field('zipcode', $data['zipcode'])->required()->max(7);

        if ($validator->isSuccess()) {
            $user = new User;
            $data['password'] = $user->hashPassword($data['password']);
            $insert = $user->insert($data);
            if ($insert) {
                return view::redirect('login');
            } else {
                return view::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            return view::render('user/create', ['errors' => $errors, 'user' => $data]);
        }
    }

    public function edit($data = [])
    {
        Auth::session();
        if (isset($data['id']) && ($data['id'] != null) && ($_SESSION['user_id'] == $data['id'])) {
            $user = new User;
            $selectId = $user->selectId($data['id']);
            if ($selectId) {
                return View::render('user/edit', ['user' => $selectId]);
            } else {
                return View::render('error', ['msg' => 'User not found!']);
            }
        } else {
            return view::redirect('login');
        }
    }

    public function update($data = [], $get = [])
    {
        Auth::session();
        $validator = new Validator;
        $validator->field('phone', $data['phone'])->min(7)->max(20);
        $validator->field('adress', $data['adress'])->required()->min(10)->max(50);
        $validator->field('zipcode', $data['zipcode'])->required()->max(7);

        $user = new User;
        $selectId = $user->selectId($get['id']);

        if ($validator->isSuccess()) {
            $update = $user->update($data, $get['id']);
            if ($update) {
                $selectId = $user->selectId($get['id']);
                $auction = new Auction;
                $selectAuctions = $auction->getAuctions($data['id']);
                if ($selectAuctions) {
                    return View::render('user/show', ['user' => $selectId, 'auctions' => $selectAuctions]);
                } else {
                    return View::render('user/show', ['user' => $selectId]);
                }
            } else {
                return view::render('error', ['msg' => 'Echec de la mise à jour!']);
            }
        } else {
            $errors = $validator->getErrors();
            return view::render('user/edit', ['errors' => $errors, 'user' => $selectId]);
        }
    }

    public function setUserInactive($data = [])
    {
        Auth::session();
        $user = new User;
        $update = $user->update(['is_actif' => 0], $data['id']);
        if ($update) {
            return view::redirect('logout');;
        } else {
            return view::render('error', ['msg' => 'Echec de la mise à jour!']);
        }
    }
}
