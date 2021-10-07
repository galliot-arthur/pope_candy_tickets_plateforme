<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    /**
     * @var Environment
     */
    protected $twig;


    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => !APP_DEV,
                'debug' => APP_DEV,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
    }

    /**
     * Return SESSION['user'] or null
     * @return void
     */
    public function userSession()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return null;
    }

    /**
     * Set result messages to user
     *
     * @param boolean $type Set the type of message : false = "danger", "true" = success
     * @param string $message Set the actual message
     * @return void
     */
    public function setFlash(bool $type, string $message)
    {
        // On définit la couleur du message avec les normes boostrap
        // true = réussite = success
        // false = echec = danger
        $color = $type === true ? 'success' : 'danger';
        $_SESSION['flash'][$color] = $message;
    }


    /**
     * Display result messages to user to appears once only.
     *
     * @return void
     */
    public function flashAlert()
    {
        $flash = [];

        // on remplace la variable de session 'flash' par une variable commune
        // flash qui ne sera affichée qu'une fois
        if (isset($_SESSION['flash']['success'])) {
            $flash['success'] = $_SESSION['flash']['success'];
        } else if (isset($_SESSION['flash']['danger'])) {
            $flash['danger'] = $_SESSION['flash']['danger'];
        }

        // on détruit la variablle de session et on retourne $flash
        unset($_SESSION['flash']);
        return $flash;
    }

    public function getTicketType(int $value): string
    {
        switch ($value) {
            case 0:
                return "normal";
            case 1:
                return "réduit";
            case 2:
                return "vip";
            case 3:
                return "guest ";
        }
    }
}
