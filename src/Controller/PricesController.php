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
                ['prices' => $prices]
            );
    }

    public function show(int $id)
    {
        $pricesModel = new PricesModel();
        $price = $pricesModel->selectOneById($id);

        return $this
            ->twig
            ->render(
                'Prices/show.html.twig',
                ['price' => $price]
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
            $id = $pricesModel->insert($prices);
            header('Location:/prices/show/' . $id);
        }

        return $this
            ->twig
            ->render("Prices/add.html.twig");
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
            $pricesModel->update($prices);
        }

        return $this
            ->twig
            ->render(
                'Prices/edit.html.twig',
                ['prices' => $prices]
            );
    }
    public function delete(int $id)
    {
        $PricesModel = new PricesModel();
        $PricesModel->delete($id);
        header('Location:/prices/index');
    }
}
