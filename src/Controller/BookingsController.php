<?php

namespace App\Controller;

use App\Model\BookingsModel;
use App\Model\Candy_showModel;
use App\Model\PricesModel;

/**
 * Class ItemController
 *
 */
class BookingsController extends AbstractController
{

    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $bookingModel = new BookingsModel();
        $booking = $bookingModel->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $booking = [
                'id' => $id,
                'ref_id' => $_POST['ref_id'],
                'ref' => $_POST['ref'],
                'type' => $_POST['type']
            ];
            $bookingModel->update($booking);
        }

        return $this
            ->twig
            ->render(
                'Bookings/edit.html.twig',
                [
                    'booking' => $booking,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'edit',
                    'currentController' => 'bookings',
                ]
            );
    }


    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function buy(int $id)
    {
        // on vérifie que l'utilisateur est bien connecté
        if (!$this->userSession()) {
            $this->setFlash(
                true,
                "Merci de vous connecter pour continuer votre commande."
            );
            header("Location:/user/login");
            exit;
        }


        //on vérifie le show que l'on est en train d'acheter
        // existe bien 
        $candy_showModel = new Candy_showModel;
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

        // On Vérifie que l'utilisateur n'as pas déja acheté le nombre
        // maximum de places pour ce concert
        $userId = ($this->userSession())['id'];

        $bookingModel = new BookingsModel;
        $bookings = $bookingModel->selectAllWhere([
            'id_user' => $userId,
            'ref_id' => $id
        ]);
        // echo "<pre>"; var_dump($bookings); echo "</pre>"; die;
        if (count($bookings) >= 3) {
            $this->setFlash(
                true,
                'Vous avez déja acheté des places pour ce concert.'
            );
            header("Location:/bookings/alreadyBought/$id");
            exit;
        } else {
            // On calcule le nombre de place que l'utilisateurs peut encore acheter
            $userCanBuy = 3 - count($bookings);
        }

        // On vient chercher tous les prix qui lui sont associés
        $pricesModel = new PricesModel;
        $prices = $pricesModel
            ->selectAllWhere([
                'venue_id' => $candy_show['venue']
            ]);
        foreach ($prices as $key => $value) {
            $prices[$key]['ticket_name'] = $this
                ->getTicketType($prices[$key]['ticket_type']);
        }

        // On affiche
        return $this
            ->twig
            ->render(
                'Bookings/buy.html.twig',
                [
                    'prices' => $prices,
                    'candy_show' => $candy_show,
                    'userCanBuy' => $userCanBuy,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'buy',
                    'currentController' => 'candy_show',
                ]
            );
    }

    public function confirm_buy()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // on vérifie les données
            $id = intval($_POST['id']);
            $quantity = $_POST['quantity'];
            $holder_name1 = $_POST['holder_name1'];
            $type1 = $_POST['type1'];
            !empty($_POST['holder_name2']) ? $holder_name2 = $_POST['holder_name2'] : $holder_name2 = null;
            !empty($_POST['type2']) ? $type2 = $_POST['type2'] : $type2 = null;
            !empty($_POST['holder_name3']) ? $holder_name3 = $_POST['holder_name3'] : $holder_name3 = null;
            !empty($_POST['type3']) ? $type3 = $_POST['type3'] : $type3 = null;

            // on recherche le spectacle correspondant et on vérifie qu'il existe
            $candyModel = new Candy_showModel;
            $candy_show = $candyModel->selectOneById($id);

            if (!$candy_show) {
                $this->setFlash(
                    false,
                    'Element inconnu.'
                );
                header("Location:/home");
            }

            $pricesModel = new PricesModel;

            $price1 = $pricesModel
                ->selectOneById($type1);
            $price1['name'] = $this
                ->getTicketType($price1['ticket_type']);
            $tickets[$holder_name1] = $price1;

            if ($quantity == 2 || $quantity == 3) {
                $price2 = $pricesModel
                    ->selectOneById($type2);
                $price2['name'] = $this
                    ->getTicketType($price2['ticket_type']);
                $tickets[$holder_name2] = $price2;
            }
            if ($quantity == 3) {
                $price3 = $pricesModel
                    ->selectOneById($type3);
                $price3['name'] = $this
                    ->getTicketType($price3['ticket_type']);
                $tickets[$holder_name3] = $price3;
            }

            $_SESSION['booking']['tickets'] = $tickets;
            $_SESSION['booking']['quantity'] = $quantity;
            $_SESSION['booking']['show'] = $candy_show;
            $_SESSION['booking']['total'] = 0;

            $initialPrice = $_SESSION['booking']['show']['price'];
            $total = 0;
            foreach ($_SESSION['booking']['tickets'] as $key => $ticket) {
                $reduction = intval($ticket['price']);
                $ticketPrice = $initialPrice - $reduction;
                $_SESSION['booking']['tickets'][$key]['ticketPrice'] = $ticketPrice;
                $_SESSION['booking']['total'] += $ticketPrice;
            }


            return $this
                ->twig
                ->render(
                    'Bookings/confirmBuy.html.twig',
                    [
                        'id' => $id,
                        'candy_show' => $candy_show,
                        'quantity' => $quantity,
                        'tickets' => $_SESSION['booking']['tickets'],
                        'total' => $_SESSION['booking']['total'],
                        'userSession' => $this->userSession(),
                        'flash' => $this->flashAlert(),
                        'currentFunction' => 'index',
                        'currentController' => 'bookinks',
                    ]
                );
        } else {
            $this->setFlash(
                false,
                'Element inconnu.'
            );
            header("Location:/home");
        }
    }

    public function payment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            return $this
                ->twig
                ->render(
                    'Bookings/payment.html.twig',
                    [
                        'id' => $_POST['id'],
                        'total' => $_SESSION['booking']['total'],
                        'candy_show' => $_SESSION['booking']['show'],
                        'tickets' => $_SESSION['booking']['tickets'],
                        'quantity' => $_SESSION['booking']['quantity'],
                        'userSession' => $this->userSession(),
                        'flash' => $this->flashAlert(),
                        'currentFunction' => 'payment',
                        'currentController' => 'bookings',
                    ]
                );
        } else {
            $this->setFlash(
                false,
                'Element inconnu.'
            );
            header("Location:/home");
        }
    }

    public function payed()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tickets = $_SESSION['booking']['tickets'];
            $idShow = intval($_POST['id']);

            $bookingModel = new BookingsModel;

            foreach ($tickets as $key => $ticket) {
                $ticket = [
                    'ref_id' => $_POST['id'],
                    'ref' => $_SESSION['booking']['show']['title'],
                    'id_user' => $_SESSION['user']['id'],
                    'holder' => $key,
                    'type' => $ticket['ticket_type'],
                ];
                $bookingModel->insert($ticket);
            }
            $candy_showModel = new Candy_showModel;
            $show = $candy_showModel->selectOneById($idShow);

            $candy_show = [
                'id' => $idShow,
                'sales' => $show['sales'] + $_SESSION['booking']['quantity']
            ];
            $candy_showModel->update($candy_show);


            $this->setFlash(
                true,
                'Bravo pour votre achat et bon concert !
                <i class="fa fa-music" aria-hidden="true"></i>'
            );
            header("Location:/home/index");
            unset($_SESSION['booking']);
        } else {
            $this->setFlash(
                false,
                'Element inconnu.'
            );
            header("Location:/home/index");
        }
    }

    public function alreadyBought(int $show_id)
    {

        $user_id = $_SESSION['user']['id'];

        $bookingModel = new BookingsModel;
        $tickets = $bookingModel->getUserShow($user_id, $show_id);

        return $this
            ->twig
            ->render(
                'User/buyedTickets.html.twig',
                [
                    'tickets' => $tickets,
                    'currentController' => 'bookings',
                    'pageFunction' => 'alreadyBought',
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }
}
