<?php

namespace App\Controller;

use App\Model\UserModel;

class UserController extends AbstractController
{
    /**
     * Display item listing
     * @return string
     */
    public function index()
    {
        $userModel = new UserModel;
        $users = $userModel->selectAll();

        return $this
            ->twig
            ->render(
                'User/index.html.twig',
                [
                    'users' => $users,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    /**
     * Display item edition page specified by $id
     * @param int $id
     * @return string
     */
    public function edit(int $id): string
    {
        $userModel = new UserModel;
        $user = $userModel->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // on vérifie d'abords que les éléments ne sont pas vides
            if (
                empty($_POST['name']) ||
                empty($_POST['firstname']) ||
                empty($_POST['email']) ||
                empty($_POST['adress'])  ||
                empty($_POST['age'])
            ) {
                $this->setFlash(
                    false,
                    'Parametres invalides, merci de rééssayer.'
                );
                $this->setFlash(
                    true,
                    "Profile edité avec succès"
                );
                header("Location:/user/edit/$id");
                exit;
            }

            $user = [
                'id' => $id,
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'firstname' => $_POST['firstname'],
                'adress' => $_POST['adress'],
                'age' => $_POST['age'],
            ];
            $userModel->update($user);
            header("Location: /user/profile/$id");
            exit;
        }

        return $this
            ->twig
            ->render(
                'User/edit.html.twig',
                [
                    'user' => $user,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    /**
     * Display item creation page
     * @return string
     */
    public function register()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // on vérifie d'abords que les éléments ne sont pas vides
            if (
                empty($_POST['name']) ||
                empty($_POST['email']) ||
                empty($_POST['password']) ||
                empty($_POST['firstname']) ||
                empty($_POST['firstname'])  ||
                empty($_POST['adress'])  ||
                empty($_POST['age'])
            ) {
                $this->setFlash(
                    false,
                    'Parametres invalides, merci de rééssayer.'
                );
                header("Location:/user/register");
                exit;
            }

            $pass = password_hash(
                $_POST['password'],
                PASSWORD_BCRYPT
            );

            $userModel = new UserModel;
            $item = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $pass,
                'firstname' => $_POST['firstname'],
                'adress' => $_POST['adress'],
                'age' => $_POST['age'],
            ];
            $userModel->insert($item);
            $this->setFlash(
                true,
                'Vous êtes maintenant enregistré, merci de vous connecter.'
            );
            header("Location:/user/login");
            exit;
        }

        return $this
            ->twig
            ->render(
                'User/add.html.twig',
                [
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    /**
     * Handle item deletion
     * @param int $id
     */
    public function delete(int $id)
    {
        $userModel = new UserModel;
        $userModel->delete($id);
        header('Location:/user/index');
    }

    /**
     * handle the user login
     * @return void
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new UserModel;
            $userNameOrEmail = $_POST['user'];

            $user = $userModel
                ->findByNameOrEmail($userNameOrEmail);
            if ($user) {

                if (password_verify($_POST['password'], $user['password'])) {
                    $this->setSession(
                        $user['id'],
                        $user['firstname'],
                        $user['email'],
                        $user['admin']
                    );
                    header("Location: /home");
                    exit;
                }
            }
            $this->setFlash(
                false,
                'Utilisateur inconnu ou mots de passe incorrect.'
            );
        }

        return $this
            ->twig
            ->render(
                "User/login.html.twig",
                [
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    /**
     * Handle the user logout
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['user']);
        $this->setFlash(true, 'Vous êtes bien déconnecté.');
        header("Location: /home");
    }

    /**
     * Create User Session
     * @param integer $id User ID
     * @param string $username User name
     * @param string $email User email
     * @param integer $admin User role (admin or not)
     * @return void
     */
    public function setSession(int $id, string $username, string $email, int $admin = null): void
    {
        $_SESSION['user'] = [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'admin' => $admin
        ];
    }


    /**
     * Handle the personal display of the user profile.
     * @return void
     */
    public function profile()
    {
        $user = $this->userSession();

        if ($user && $user['id']) {
            $userModel = new UserModel;
            $userProfile = $userModel->selectOneById($user['id']);

            return $this
                ->twig
                ->render(
                    'User/profile.html.twig',
                    [
                        'userProfile' => $userProfile,
                        'currentController' => 'user',
                        'pageFunction' => 'profile',
                        'userSession' => $this->userSession(),
                        'flash' => $this->flashAlert()
                    ]
                );
        } else {
            $this->setFlash(
                false,
                'Element inconnu.'
            );
            header("Location:/home");
            exit;
        }
    }
}
