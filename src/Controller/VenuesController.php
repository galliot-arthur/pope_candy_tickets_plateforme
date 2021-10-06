<?php

namespace App\Controller;


use App\Model\VenuesModel;

/**
 * Class ItemController
 *
 */
class VenuesController extends AbstractController
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
        $venuesModel = new VenuesModel();
        $venues = $venuesModel->selectAll();

        return $this
            ->twig
            ->render(
                'Item/index.html.twig',
                [
                    'venues' => $venues,
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
        $venuesModel = new VenuesModel();
        $venue = $venuesModel->selectOneById($id);

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
                'Venues/show.html.twig',
                [
                    'venue' => $venue,
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
        $venuesModel = new VenuesModel();
        $venue = $venuesModel->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $venue = [
                'id' => $id,
                'ref_id' => $_POST['ref_id'],
                'ref' => $_POST['ref'],
                'type' => $_POST['type']
            ];
            $venuesModel->update($venue);
        }

        return $this
            ->twig
            ->render(
                'Venues/edit.html.twig',
                [
                    'venue' => $venue,
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
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $venuesModel = new VenuesModel();
            $venue = [
                'ref_id' => $_POST['ref_id'],
                'ref' => $_POST['ref'],
                'type' => $_POST['type']
            ];
            $id = $venuesModel->insert($venue);
            if ($id) {
                $this->setFlash(

                    true,
                    "votre Venues à bien été ajouté"

                );
            };
            header('Location:/home');
            exit;
        }

        return $this
            ->twig
            ->render(
                'Venues/add.html.twig',
                [
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
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
        $venuesModel = new VenuesModel();
        $venuesModel->delete($id);
        header('Location:/item/index');
    }
}
