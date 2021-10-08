<?php

namespace App\Controller;

use App\Model\ImagesModel;

class ImagesController extends AbstractController
{

    public function index()
    {
        $imagesModel = new ImagesModel();
        $images = $imagesModel->selectAll();

        return $this
            ->twig
            ->render(
                'images/index.html.twig',
                [
                    'images' => $images,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    public function show(int $id)
    {
        $imagesModel = new ImagesModel();
        $image = $imagesModel->selectOneById($id);

        if (!$image) {
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
                'images/show.html.twig',
                [
                    'id' => $id,
                    'images' => $image,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagesModel = new imagesModel();
            $images = [
                'id' => $_POST['id'],
                'alt' => $_POST['alt'],
                'context' => $_POST['context'],

            ];
            $id = $imagesModel->insert($images);

            if ($id) {

                $this->setFlash(
                    true,
                    "Cet imagee a bien été ajouté."
                );
                header("Location:/images/show/$id");
                exit;
            } else {

                $this->setFlash(
                    false,
                    "Erreur, merci d'essayer à nouveau."
                );
                header("Location:/images/add");
                exit;
            }

            header("Location:/images/show/$id");
            exit;
        }



        return $this
            ->twig
            ->render(
                "images/add.html.twig",
                [
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    public function edit(int $id): string
    {
        $imagesModel = new ImagesModel();
        $images = $imagesModel->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $images = [
                'id' => $_POST['id'],
                'alt' => $_POST['alt'],
                'context' => $_POST['context'],

            ];
            $result = $imagesModel->update($images);

            if ($result) {

                $this->setFlash(
                    true,
                    "Cette image bien à bien été édité."
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
                'images/edit.html.twig',
                [
                    'id' => $id,
                    'images' => $images,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }
    public function delete(int $id)
    {
        $imagesModel = new ImagesModel();
        $result = $imagesModel->delete($id);

        if ($result) {

            $this->setFlash(
                true,
                "Cette image a bien été supprimé."
            );
        } else {

            $this->setFlash(
                false,
                "Erreur, merci d'essayer à nouveau."
            );
            header("Location:/images/show/$id");
            exit;
        }
        header('Location:/images/index');
    }
}