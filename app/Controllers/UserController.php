<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Color;

require_once __DIR__ . '/../Helpers/view_helper.php';

class UserController
{
    public static function index()
    {
        $users = User::all();

        View('users/index', [
            'title' => 'Lista de Usuários',
            'users' => $users,
        ]);
    }

    public static function create()
    {
        View('users/form', [
            'title' => 'Criar Usuário',
            'user' => ['name' => '', 'email' => ''],
            'colors' => Color::all(),
            'selectedColors' => [],
            'action' => 'store',
        ]);
    }

    public static function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            self::redirectToIndex();
            return;
        }

        $colors = Color::all();

        $userColors = $user['colors'] ?? [];
        $selectedColors = [];

        foreach ($colors as $color) {
            if (in_array($color['name'], $userColors)) {
                $selectedColors[] = $color['id'];
            }
        }

        View('users/form', [
            'title' => 'Editar Usuário',
            'user' => $user,
            'colors' => $colors,
            'selectedColors' => $selectedColors,
            'action' => "update&id=$id",
        ]);
    }


    public static function store()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $colors = $_POST['colors'] ?? [];

        User::create($name, $email, $colors);

        self::redirectToIndex();
    }

    public static function update($id)
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $colors = $_POST['colors'] ?? [];

        User::update($id, $name, $email, $colors);

        self::redirectToIndex();
    }

    public static function delete($id)
    {
        User::delete($id);

        self::redirectToIndex();
    }

    private static function redirectToIndex()
    {
        header('Location: index.php?route=users');
        exit;
    }
}
