<?php

namespace App\Controller;

use App\Model\ArtistsModel;
use App\Model\Candy_showModel;

class Candy_showController extends AbstractController
{

    public function index()
    {
        $candy_showModel = new Candy_showModel();
        $candy_show = $candy_showModel->selectAll();

        return $this->twig->render('Candy_show/index.html.twig', ['candy_show' => $candy_show]);
    }

    public function show(int $id)
    {
        $candy_showModel = new Candy_showModel();
        $candy_show = $candy_showModel
            ->selectOneById($id);

        if (!$candy_show) {
            $this->setFlash(
                false,
                'Element inconnu.'
            );
            header("Location:/home");
            exit;
        }

        return $this->twig->render('Candy_show/show.html.twig', ['candy_show' => $candy_show]);
    }

    public function add()
    {
        $artistsModel = new ArtistsModel;
        $artists = $artistsModel->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $candy_showModel = new Candy_showModel();
            $candy_show = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'venue' => $_POST['venue'],
                'first_part' => $_POST['first_part'],
                'first_part_website' => $_POST['first_part_website'],
                'price' => $_POST['price'],
                'show_start' => $_POST['show_start'],
                'show_end' => $_POST['show_end'],
                'sales_on' => $_POST['sales_on'],
                'sold_out' => $_POST['sold_out'],
                'sales' => $_POST['sales'],
            ];

            $id = $candy_showModel->insert($candy_show);
            $this->setFlash(
                true,
                'Vous avez bien ajouté un spectacle'
            );
            header("Location:/candy_show/show/$id");
            exit;
        }

        return $this
            ->twig
            ->render(
                "Candy_show/add.html.twig",
                [
                    'artists' => $artists,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    public function edit(int $id): string
    {
        $candy_showModel = new Candy_showModel();
        $candy_show = $candy_showModel->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $candy_show = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'venue' => $_POST['venue'],
                'first_part' => $_POST['first_part'],
                'first_part_website' => $_POST['first_part_website'],
                'price' => $_POST['price'],
                'show_start' => $_POST['show_start'],
                'show_end' => $_POST['show_end'],
                'sales_on' => $_POST['sales_on'],
                'sold_out' => $_POST['sold_out'],
                'sales' => $_POST['sales'],
            ];
            $candy_showModel->update($candy_show);
        }

        return $this->twig->render('candy_show/edit.html.twig', ['candy_show' => $candy_show]);
    }
    public function delete(int $id)
    {
        $Candy_showModel = new Candy_showModel();
        $Candy_showModel->delete($id);
        header('Location:/candy_show/index');
    }
}
