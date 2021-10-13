<?php

namespace App\Controller;

use App\Model\Candy_showModel;
use App\Model\ImagesModel;
use App\Model\ArtistsModel;
use App\Model\VenueModel;


class SearchController extends AbstractController
{

    /**
     * Display home page
     * @return string
     */
    public function index()
    {

        $searchModel = new SearchModel;
        $search = $searchModel->allShowsWithArtist();
        
        $search = $this->getSalesStatusArray($search);
        $top_shows = $this->getSalesStatusArray($top_shows);

        $searchModel = new SearchModel;
        $pictures = $searchModel->selectAll();

        return $this
            ->twig
            ->render(
                'Search/index.html.twig',
                [
                    'search' => $search,
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
                "Search/index.html.twig",
                [
                    'userSession' => $this->userSession(),
                    'flash' => $this->flashAlert(),
                    'currentFunction' => 'index',
                    'currentController' => 'home',
                ]
            );
    }
}
