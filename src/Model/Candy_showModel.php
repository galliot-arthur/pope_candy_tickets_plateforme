<?php

namespace App\Model;

class Candy_showModel extends AbstractModel
{
    /**
     *
     */
    const TABLE = 'candy_show';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

}
