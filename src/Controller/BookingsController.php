<?php

namespace App\Controller;

use App\Model\BookingsModel;
use App\Model\Candy_showModel;

/**
 * Class ItemController
 *
 */
class BookingsController extends AbstractController
{


    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $bookingModel = new BookingsModel();
        $bookings = $bookingModel->selectAll();

        return $this
            ->twig
            ->render(
                'Bookings/index.html.twig',
                [
                    'bookings' => $bookings,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }


    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $bookingModel = new BookingsModel();
        $booking = $bookingModel->selectOneById($id);

        if (!$booking) {
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
                'Bookings/show.html.twig',
                [
                    'booking' => $booking,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }


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
                    'flash' => $this->flashAlert()
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
        $candy_showModel = new Candy_showModel;
        $candy_show = $candy_showModel
            ->selectOneById($id);



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingModel = new BookingsModel;
            $booking = [
                'ref_id' => $_POST['ref_id'],
                'ref' => $_POST['ref'],
                'type' => $_POST['type']
            ];
            $id = $bookingModel->insert($booking);
            if ($id) {
                $this->setFlash(

                    true,
                    "votre booking à bien été ajouté"

                );
            };
            header('Location:/home');
            exit;
        }



        return $this
            ->twig
            ->render(
                'Bookings/buy.html.twig',
                [
                    'candy_show' => $candy_show
                ]
            );
    }


    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $bookingModel = new BookingsModel();
        $bookingModel->delete($id);
        header('Location:/bookings/index');
    }
}
