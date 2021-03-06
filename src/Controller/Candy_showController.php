<?php

namespace App\Controller;

use App\Model\ArtistsModel;
use App\Model\BookingsModel;
use App\Model\Candy_showModel;
use App\Model\VenueModel;

class Candy_showController extends AbstractController
{

    public function index()
    {
        $candy_showModel = new Candy_showModel;
        $candy_shows = $candy_showModel->allShowsWithArtist('show_start', false);
        $candy_shows = $this->getSalesStatusArray($candy_shows);

        return $this
            ->twig
            ->render(
                'Candy_show/index.html.twig',
                [
                    'candy_shows' => $candy_shows,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'index',
                    'currentController' => 'candy_show',
                ]
            );
    }

    public function show(int $id)
    {
        $candy_showModel = new Candy_showModel;
        $candy_show = $candy_showModel
            ->oneShowsWithArtist($id);
        if (!$candy_show) {
            $this->setFlash(
                false,
                'Element inconnu.'
            );
            header("Location:/home");
            exit;
        }
        // On vérifie que le concert n'est pas déja complet, 
        // au quel cas on bloque la possibilité d'acheter
        $sold_out = $this
            ->getSalesStatus(
                $candy_show['sales'],
                $candy_show['capacity']
            );
        // On Vérifie que l'utilisateur n'as pas déja acheté le nombre
        // maximum de places pour ce concert
        if ($this->userSession()) {
            $userId = ($this->userSession())['id'];
            $bookingModel = new BookingsModel;
            $bookings = $bookingModel->selectAllWhere([
                'id_user' => $userId
            ]);
            if (count($bookings) >= 3) {
                $alreadyBought = true;
            } else {
                $alreadyBought = false;
            }
        } else {
            $alreadyBought = false;
        }
        $address = str_replace(
            ' ',
            '+',
            str_replace(
                ['.', ','],
                '',
                $candy_show['venueAddress']
            )
        );

        return $this
            ->twig
            ->render(
                'Candy_show/show.html.twig',
                [
                    'id' => $id,
                    'candy_show' => $candy_show,
                    'sold_out' => $sold_out,
                    'address' => $address,
                    'alreadyBought' => $alreadyBought,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'show',
                    'currentController' => 'candy_show',
                ]
            );
    }

    public function add()
    {
        $artistsModel = new ArtistsModel;
        $artists = $artistsModel->selectAll();
        $venueModel = new VenueModel;
        $venues = $venueModel->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $show_date = $_POST['show_date'];
            $start_hour = $_POST['start_hour'];
            $end_hour = $_POST['end_hour'];

            $show_start = "$show_date $start_hour:00";
            $show_end = "$show_date $end_hour:00";

            $candy_showModel = new Candy_showModel;
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
                    'venues' => $venues,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'add',
                    'currentController' => 'candy_show',
                ]
            );
    }

    public function edit(int $id): string
    {
        $candy_showModel = new Candy_showModel;
        $candy_show = $candy_showModel->selectOneById($id);

        $artistsModel = new ArtistsModel;
        $artists = $artistsModel->selectAll();
        $venueModel = new VenueModel;
        $venues = $venueModel->selectAll();

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

            $candy_showModel = new Candy_showModel;
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
                    'id' => $id,
                    'candy_show' => $candy_show,
                    'artists' => $artists,
                    'venues' => $venues,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'edit',
                    'currentController' => 'candy_show',
                ]
            );
    }
    public function delete(int $id)
    {
        $Candy_showModel = new Candy_showModel;
        $Candy_showModel->delete($id);
        header('Location:/candy_show/index');
    }
}
