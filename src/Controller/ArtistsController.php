<?php

namespace App\Controller;

use App\Model\ArtistsModel;

class ArtistsController extends AbstractController
{

    public function index()
    {
        $artistsModel = new ArtistsModel();
        $artists = $artistsModel->selectAll();

        return $this
            ->twig
            ->render(
                'Artists/index.html.twig',
                [
                    'artists' => $artists,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    public function show(int $id)
    {
        $artistsModel = new ArtistsModel();
        $artist = $artistsModel->selectOneById($id);

        if (!$artist) {
            $this->setFlash(
                false,
                'Element inconnu.'
            );
            header("Location:/home");
            exit;
        }

        return $this
            ->twig
            ->render(
                'Artists/show.html.twig',
                [
                    'id' => $id,
                    'artists' => $artist,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $artistsModel = new ArtistsModel();
            $artists = [
                'id_name' => $_POST['id'],
                'name' => $_POST['name'],
                'biography' => $_POST['biography'],
                'website' => $_POST['website'],

            ];
            $id = $artistsModel->insert($artists);

            if ($id) {

                $this->setFlash(
                    true,
                    "Cet Artiste a bien été ajouté."
                );
                header("Location:/artists/show/$id");
                exit;
            } else {

                $this->setFlash(
                    false,
                    "Erreur, merci d'essayer à nouveau."
                );
                header("Location:/artists/add");
                exit;
            }

            header("Location:/artists/show/$id");
            exit;
        }



        return $this
            ->twig
            ->render(
                "Artists/add.html.twig",
                [
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    public function edit(int $id): string
    {
        $artistsModel = new ArtistsModel();
        $artists = $artistsModel->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $artists = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'biography' => $_POST['biography'],
                'website' => $_POST['website'],

            ];
            $result = $artistsModel->update($artists);

            if ($result) {

                $this->setFlash(
                    true,
                    "Ce prix bien à bien été édité."
                );
            } else {

                $this->setFlash(
                    false,
                    "Erreur, merci d'essayer à nouveau."
                );
            }
        }

        return $this
            ->twig
            ->render(
                'Artists/edit.html.twig',
                [
                    'id' => $id,
                    'artists' => $artists,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }
    public function delete(int $id)
    {
        $ArtistsModel = new ArtistsModel();
        $result = $ArtistsModel->delete($id);

        if ($result) {

            $this->setFlash(
                true,
                "Ce prix bien à bien été supprimé."
            );
        } else {

            $this->setFlash(
                false,
                "Erreur, merci d'essayer à nouveau."
            );
            header("Location:/artists/show/$id");
            exit;
        }
        header('Location:/artists/index');
    }
}
