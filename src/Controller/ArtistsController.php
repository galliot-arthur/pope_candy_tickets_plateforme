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

        return $this
            ->twig
            ->render(
                'Artists/show.html.twig',
                [
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
            header("Location:/artists/show/$id");
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
            $artistsModel->update($artists);
        }

        return $this
            ->twig
            ->render(
                'Artists/edit.html.twig',
                [
                    'artists' => $artists,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }
    public function delete(int $id)
    {
        $ArtistsModel = new ArtistsModel();
        $ArtistsModel->delete($id);
        header('Location:/artists/index');
    }
}
