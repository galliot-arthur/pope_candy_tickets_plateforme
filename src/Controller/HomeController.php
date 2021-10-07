<?php

namespace App\Controller;

use App\Model\Candy_showModel;

class HomeController extends AbstractController
{

    /**
     * Display home page
     * @return string
     */
    public function index()
    {

        $candy_showModel = new Candy_showModel;
        $candy_shows = $candy_showModel->allOrderedBy('show_start', false);
        $top_shows = $candy_showModel->allShowsWithArtist();

        return $this
            ->twig
            ->render(
                'Home/index.html.twig',
                [
                    'candy_shows' => $candy_shows,
                    'top_shows' => $top_shows,
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'index',
                    'currentController' => 'home',
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
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'index',
                    'currentController' => 'home',
                ]
            );
    }
}
