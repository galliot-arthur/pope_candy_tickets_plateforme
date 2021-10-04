<?php

namespace App\Model;

class PricesModel extends AbstractModel
{
    /**
     *
     */
    const TABLE = 'prices';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
