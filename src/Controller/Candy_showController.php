<?php

namespace App\Controller;

use App\Model\ArtistsModel;
use App\Model\Candy_showModel;

class Candy_showController extends AbstractController
{

    public function index()
    {
        $candy_showModel = new Candy_showModel();
        $candy_show = $candy_showModel->allOrderedBy('show_start', false);

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

        return $this
            ->twig
            ->render(
                'Candy_show/show.html.twig',
                [
                    'candy_show' => $candy_show,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    public function add()
    {
        $artistsModel = new ArtistsModel;
        $artists = $artistsModel->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $show_date = $_POST['show_date'];
            $start_hour = $_POST['start_hour'];
            $end_hour = $_POST['end_hour'];

            $show_start = "$show_date $start_hour:00";
            $show_end = "$show_date $end_hour:00";

            $candy_showModel = new Candy_showModel();
            $candy_show = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'venue' => $_POST['venue'],
                'first_part' => $_POST['first_part'],
                'price' => $_POST['price'],
                'show_start' => $show_start,
                'show_end' => $show_end,
                'sales_on' => $_POST['sales_on'],
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

        $artistsModel = new ArtistsModel;
        $artists = $artistsModel->selectAll();

        if (!$candy_show) {
            $this->setFlash(
                false,
                'Element inconnu.'
            );
            header("Location:/home");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $show_date = $_POST['show_date'];
            $start_hour = $_POST['start_hour'];
            $end_hour = $_POST['end_hour'];

            $show_start = "$show_date $start_hour:00";
            $show_end = "$show_date $end_hour:00";

            $candy_showModel = new Candy_showModel();
            $candy_show = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'venue' => $_POST['venue'],
                'first_part' => $_POST['first_part'],
                'price' => $_POST['price'],
                'show_start' => $show_start,
                'show_end' => $show_end,
                'sales_on' => $_POST['sales_on'],
            ];

            $result = $candy_showModel->update($candy_show);
            if ($result) {
                $this->setFlash(
                    true,
                    "Ce concert à bien été édité."
                );
            };
            
        }

        return $this
            ->twig
            ->render(
                'candy_show/edit.html.twig',
                [
                    'candy_show' => $candy_show,
                    'artists' => $artists,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }
    public function delete(int $id)
    {
        $Candy_showModel = new Candy_showModel();
        $Candy_showModel->delete($id);
        header('Location:/candy_show/index');
    }
}
