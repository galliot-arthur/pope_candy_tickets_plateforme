<?php

namespace App\Controller;

use App\Model\Candy_showModel;
use App\Model\ImagesModel;

class HomeController extends AbstractController
{

    /**
     * Display home page
     * @return string
     */
    public function index()
    {

        $candy_showModel = new Candy_showModel;
        $candy_shows = $candy_showModel->allShowsWithArtist();
        $top_shows = $candy_showModel->allShowsWithArtist();

        $candy_shows = $this->getSalesStatusArray($candy_shows);
        $top_shows = $this->getSalesStatusArray($top_shows);

        $imageModel = new ImagesModel;
        $pictures = $imageModel->selectAll();

        return $this
            ->twig
            ->render(
                'Home/index.html.twig',
                [
                    'candy_shows' => $candy_shows,
                    'top_shows' => $top_shows,
                    'pictures' => $pictures,
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
