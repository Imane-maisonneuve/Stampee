<?php

namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\User;
use App\Models\Client;
use App\Models\Journal;


class AuthController
{
    public function create()
    {
        return View::render('auth/create');
    }

    public function show($data)
    {
        $validator = new Validator;
        $validator->field('email', $data['email'])->required()->max(50)->email();
        $validator->field('password', $data['password'])->min(6)->max(20);

        if ($validator->isSuccess()) {

            $user = new User;
            $checkuser = $user->checkUser($data['email'], $data['password']);
            if ($checkuser) {
                return View::redirect('sites');
            } else {
                $client = new Client;
                $checkclient = $client->checkclient($data['email'], $data['password']);
                if ($checkclient) {
                    return View::redirect('sites');
                } else {
                    $errors['message'] = "Veuillez vérifier vos identifiants";
                    return view::render('auth/create', ['errors' => $errors, 'user' => $data]);
                }
            }
        } else {
            $errors = $validator->getErrors();
            return view::render('auth/create', ['errors' => $errors, 'user' => $data]);
        }
    }

    public function delete()
    {
        session_destroy();
        return View::redirect('login');
    }
}
