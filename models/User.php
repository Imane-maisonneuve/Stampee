<?php

namespace App\Models;

use App\Models\CRUD;

class User extends CRUD
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'surname', 'phone', 'email', 'password', 'adress', 'zipcode', 'is_actif'];

    public function hashPassword($password, $cost = 10)
    {
        $options = [
            'cost' => $cost
        ];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function checkUser($email, $password)
    {
        $user = $this->unique('email', $email);
        if ($user) {
            if (password_verify($password, $user['password']) && ($user['is_actif'] === 1)) {
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_surname'] = $user['surname'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                return true;
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }
}
