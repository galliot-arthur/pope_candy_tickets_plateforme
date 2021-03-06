<?php

namespace App\Controller;

use App\Controller\Image;
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
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'index',
                    'currentController' => 'images',
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
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'show',
                    'currentController' => 'images',
                ]
            );
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_FILES)) {
                $this->setFlash(
                    false,
                    'Merci de joindre un fichier.'
                );
                header("Location:/images/add");
                exit;
            }

            $imagesModel = new imagesModel();
            $images = [
                'alt' => $_POST['alt'],
                'context' => $_POST['context'],

            ];
            $id = $imagesModel->insert($images);

            if (!$id) {
                $this->setFlash(
                    false,
                    'Erreur dans la base de donn??e.'
                );
                header("Location:/images/add");
                exit;
            }


            $image = new Image;
            $result = $image->create($id, 'photos');

            if ($result) {
                $this->setFlash(
                    true,
                    "Cet imagee a bien ??t?? ajout??."
                );
                header("Location:/images/show/$id");
                exit;
            } else {
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
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'add',
                    'currentController' => 'images',
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
                    "Cette image bien ?? bien ??t?? ??dit??."
                );
            } else {

                $this->setFlash(
                    false,
                    "Erreur, merci d'essayer ?? nouveau."
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
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'edit',
                    'currentController' => 'images',
                ]
            );
    }
    public function delete(int $id)
    {
        $imageDatabase = new ImagesModel;
        $imageFileInServer = new Image;
        $imageDatabase->delete($id);
        $imageFileInServer->delete($id, 'photos');


        $this->setFlash(
            true,
            "Cette photo a bien ??t?? supprim??."
        );
        header('Location:/images/index');
        exit;
    }
}
