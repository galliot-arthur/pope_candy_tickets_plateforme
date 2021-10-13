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
        if(isset($_POST['search']) AND !empty($_POST['search'])) {
            $search = htmlspecialchars($_POST['search']);

            $searchModel = new Candy_showModel;

            $results = $searchModel->search($search);

            
            
            // if($articles->rowCount() == 0) {
                // $articles = $bdd->query('SELECT titre FROM articles WHERE CONCAT(titre, contenu) LIKE "%'.$q.'%" ORDER BY id DESC');
            // }
        }

        
    

        return $this
            ->twig
            ->render(
                'Search/index.html.twig',
                [
                    'results' => $results,
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
