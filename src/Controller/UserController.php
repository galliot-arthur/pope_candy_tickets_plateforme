<?php

namespace App\Controller;

use App\Model\UserModel;

class UserController extends AbstractController
{



    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new UserModel();
            $item = [
                'name' => $_POST['name'],
                'surname' => $_POST['surname'],
                'adress' => $_POST['adress'],
                'age' => $_POST['age'],
            ];
            $id = $userModel->insert($item);

            header("Location:/user/login/");
        }

        return $this->twig->render('User/add.html.twig');
    }
}