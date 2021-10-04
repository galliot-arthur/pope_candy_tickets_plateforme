<?php

namespace App\Controller;

use App\Model\UserModel;

class UserController extends AbstractController
{
    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->selectAll();

        return $this->twig->render('User/index.html.twig', ['users' => $users]);
    }


    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $userModel = new UserModel();
        $user = $userModel->selectOneById($id);

        return $this->twig->render('User/show.html.twig', ['user' => $user]);
    }

    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $userModel = new UserModel();
        $user = $userModel->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user= [
                'id' => $id,
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'firstname' => $_POST['firstname'],
                'adress' => $_POST['adress'],
                'age' => $_POST['age'],
            ];
            $userModel->update($user);
            header("Location: /user/show/$id");
            exit;
        }

        return $this->twig->render('User/edit.html.twig', ['user' => $user]);
    }
    
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
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'firstname' => $_POST['firstname'],
                'adress' => $_POST['adress'],
                'age' => $_POST['age'],
            ];
            $userModel->insert($item);

            header("Location:/user/index");
        }

        return $this->twig->render('User/add.html.twig');
    }

        /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        header('Location:/user/index');
    }
}