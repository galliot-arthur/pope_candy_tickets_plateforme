<?php

namespace App\Controller;


use App\Model\VenueModel;

/**
 * Class ItemController
 *
 */
class VenueController extends AbstractController
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
        $venueModel = new VenueModel;
        $venues = $venueModel->selectAll();

        return $this
            ->twig
            ->render(
                'Venue/index.html.twig',
                [
                    'venues' => $venues,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'index',
                    'currentController' => 'venue',
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
        $venueModel = new VenueModel();
        $venue = $venueModel->selectOneById($id);

        if (!$venue) {
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
                'Venue/show.html.twig',
                [
                    'id' => $id,
                    'venue' => $venue,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'show',
                    'currentController' => 'venue',
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
        $venueModel = new VenueModel();
        $venue = $venueModel->selectOneById($id);

        if (!$venue) {
            $this->setFlash(
                false,
                'Element inconnu.'
            );
            header("Location:/home");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $venue = [
                'id' => $id,
                'title' => $_POST['title'],
                'town' => $_POST['town'],
                'disabled_access' => $_POST['disabled_access'],
                'address' => $_POST['address'],
                'capacity' => $_POST['capacity'],
                'vip_available' => $_POST['vip_available'],
                'prices' => $_POST['prices']
            ];
            $result = $venueModel->update($venue);
            if ($result) {
                $this->setFlash(
                    true,
                    "Ce lieu à bien été édité."
                );
            };
        }

        return $this
            ->twig
            ->render(
                'Venue/edit.html.twig',
                [
                    'id' => $id,
                    'venue' => $venue,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'edit',
                    'currentController' => 'venue',
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
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $venueModel = new VenueModel();
            $venue = [
                'title' => $_POST['title'],
                'town' => $_POST['town'],
                'disabled_access' => $_POST['disabled_access'],
                'address' => $_POST['address'],
                'capacity' => $_POST['capacity'],
                'vip_available' => $_POST['vip_available'],
                'prices' => $_POST['prices'],
            ];
            $id = $venueModel->insert($venue);

            if ($id) {
                $this->setFlash(
                    true,
                    "Ce lieu à bien été ajouté."
                );
            };
            header('Location:/venue/index');
            exit;
        }

        return $this
            ->twig
            ->render(
                'Venue/add.html.twig',
                [
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'add',
                    'currentController' => 'venue',
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
        $venueModel = new VenueModel();
        $venueModel->delete($id);
        $this->setFlash(
            true,
            "Ce lieu à bien été supprimée"
        );
        header('Location:/venue/index');
    }

    public function addImage(int $id)
    {
        // if ($_FILES['image']['name']) {

        //     if (!isset($_FILES)) {
        //         $this->setFlash(
        //             false,
        //             'Merci de joindre un fichier.'
        //         );
        //         header("Location:/images/add");
        //         exit;
        //     }

        //     $imagesModel = new imagesModel();
        //     $images = [
        //         'alt' => $_POST['alt'],
        //         'context' => $_POST['context'],

        //     ];
        //     $id = $imagesModel->insert($images);

        //     if (!$id) {
        //         $this->setFlash(
        //             false,
        //             'Erreur dans la base de donnée.'
        //         );
        //         header("Location:/images/add");
        //         exit;
        //     }

    }
}
