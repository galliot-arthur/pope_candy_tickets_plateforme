<?php

namespace App\Model;

class VenuesModel extends AbstractModel
{
    /**
     *
     */
    const TABLE = 'venue';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
