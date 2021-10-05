<?php

namespace App\Model;

use \PDO;

class Connection extends PDO
{
    /**
     * @var PDO
     *
     * @access private
     */
    private static $_instance;

    private $user;

    private $host;

    private $password;

    private $dbName;

    /**
     * Initialize connection
     *
     * @access public
     */
    public function __construct()
    {
        if (getenv('ENV') === 'prod') {
            $this->user = getenv('DB_USER');
            $this->host = getenv('DB_HOST');
            $this->password = getenv('DB_PASSWORD');
            $this->dbName = getenv('DB_NAME');
        } else {
            $this->user = APP_DB_USER;
            $this->host = APP_DB_HOST;
            $this->password = APP_DB_PWD;
            $this->dbName = APP_DB_NAME; 
        }
        try {
            parent::__construct(
                "mysql:host=$this->host; dbname=$this->dbName; charset=utf8",
                $this->user,
                $this->password
            ); 
            $this->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            ); 
            // show errors in DEV environment
            if (APP_DEV) {
                $this->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                ); 
                
            }
        } catch (\PDOException $e) {
            echo ("<div class='error'>Error !: $e->getMessage()</div>");
        }
    }


    /**
     * @return PDO $pdo
     */
    public static function getInstance(): self
    {
        //return $this->pdoConnection;
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
