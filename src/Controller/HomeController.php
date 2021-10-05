<?php

namespace App\Controller;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     */
    public function index()
    {

        return $this
            ->twig
            ->render(
                'Home/index.html.twig',
                [
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }

    public function admin()
    {

        return $this
            ->twig
            ->render(
                "Admin/index.html.twig",
                [
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert()
                ]
            );
    }
}
