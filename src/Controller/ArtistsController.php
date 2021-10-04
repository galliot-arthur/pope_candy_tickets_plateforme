<?php

namespace App\Controller;

use App\Model\ArtistsModel;

class ArtistsController extends AbstractController
{

    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ArtistsModel = new ArtistsModel();
            $artists = [
                'id_name' => $_POST['id_name'],
                'name' => $_POST['name'],
                'biography' => $_POST['biography'],
                'website' => $_POST['website'],
                
            ];
            $id = $ArtistsModel->insert($);

            header("Location:/user/login/");
        }

        return $this->twig->render('User/add.html.twig');
    }
}