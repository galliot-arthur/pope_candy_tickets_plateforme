<?php

namespace App\Model;

class ItemManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'item';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
