<?php

namespace App\Controller;

use App\Model\PricesModel;

class PricesController extends AbstractController
{

    public function index()
    {
        $pricesModel = new PricesModel();
        $prices = $pricesModel->selectAll();

        return $this
            ->twig
            ->render(
                'Prices/index.html.twig',
                [
                    'prices' => $prices,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'index',
                    'currentController' => 'prices',
                ]
            );
    }

    public function show(int $id)
    {
        $pricesModel = new PricesModel();
        $price = $pricesModel->selectOneById($id);

        if (!$price) {
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
                'Prices/show.html.twig',
                [
                    'price' => $price,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'show',
                    'currentController' => 'prices',
                ]
            );
    }

    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pricesModel = new PricesModel();
            $prices = [
                'venue_id' => $_POST['venue_id'],
                'price' => $_POST['price'],
                'ticket_type' => $_POST['ticket_type']
            ];
            $id = $pricesModel
                ->insert($prices);

            if ($id) {

                $this->setFlash(
                    true,
                    "Ce prix bien à bien été ajouté."
                );
                header("Location:/prices/show/$id");
                exit;
            } else {

                $this->setFlash(
                    false,
                    "Erreur, merci d'essayer à nouveau."
                );
                header("Location:/prices/add");
                exit;
            }
        }

        return $this
            ->twig
            ->render(
                "Prices/add.html.twig",
                [
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'add',
                    'currentController' => 'prices',
                ]
            );
    }

    public function edit(int $id): string
    {
        $pricesModel = new PricesModel();
        $prices = $pricesModel->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prices = [
                'id' => $_POST['id'],
                'venue_id' => $_POST['venue_id'],
                'price' => $_POST['price'],
                'ticket_type' => $_POST['ticket_type']
            ];
            $result = $pricesModel
                ->update($prices);

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
                'Prices/edit.html.twig',
                [
                    'prices' => $prices,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'edit',
                    'currentController' => 'prices',
                ]
            );
    }
    public function delete(int $id)
    {
        $PricesModel = new PricesModel();
        $PricesModel->delete($id);
        $this->setFlash(
            true,
            "Ce prix bien à bien été supprimé."
        );
        header('Location:/prices/index');
    }
}
