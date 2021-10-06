<?php

namespace App\Controller;

use App\Model\PricesModel;
use App\Model\VenueModel;

class PricesController extends AbstractController
{

    public function index()
    {
        $pricesModel = new PricesModel;
        $prices = $pricesModel->selectAll();
        $venueModel = new VenueModel;

        foreach($prices as $key => $value) {
            $prices[$key]['ticket_name'] = $this->getTicketType($prices[$key]['ticket_type']);
            $venue = $venueModel->selectOneById($prices[$key]['venue_id']);
            $prices[$key]['venue_name'] = $venue['title'];
        }

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
                    'id' => $id,
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
        $venueModel = new VenueModel;
        $venues = $venueModel->selectAll();

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
                header("Location:/prices/index");
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
                    'venues' => $venues,
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
        $venueModel = new VenueModel;
        $venues = $venueModel->selectAll();

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
                header("Location:/prices/index");
                exit;
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
                    'id' => $id,
                    'prices' => $prices,
                    'venues' => $venues,
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
        public function getTicketType(int $value):string
    {
        switch ($value){
            case 0:
                return "normal";
            case 1:
                return "réduit";
            case 2:
                return "vip";
            case 3:
                return "guest ";
        }
    }
}