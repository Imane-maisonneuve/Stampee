<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\User;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController
{
    public function __construct()
    {
        Auth::session();
    }

    public function index()
    {
        Auth::session();
        $user = new User;
        $select = $user->select('id');

        return View::render("user/index", ['user' => $select]);
    }

    public function create()
    {
        return View::render('user/create');
    }

    public function store($data)
    {
        $validator = new Validator;
        $validator->field('surname', $data['surname'])->required()->min(2)->max(50);
        $validator->field('name', $data['name'])->required()->min(2)->max(50);
        $validator->field('adress', $data['adress'])->required()->min(10)->max(50);
        $validator->field('zipcode', $data['zipcode'])->required()->max(7);
        $validator->field('phone', $data['phone'])->min(7)->max(20);
        $validator->field('email', $data['email'])->required()->max(50)->email()->unique('User');
        $validator->field('password', $data['password'])->required()->min(6)->max(20);

        if ($validator->isSuccess()) {
            $user = new User;
            $data['password'] = $user->hashPassword($data['password']);
            $insert = $user->insert($data);
            if ($insert) {
                return view::redirect('users');
            } else {
                return view::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return view::render('user/create', ['errors' => $errors, 'user' => $data]);
        }
    }
}
