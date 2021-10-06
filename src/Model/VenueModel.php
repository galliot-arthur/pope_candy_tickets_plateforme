<?php

namespace App\Model;

class VenueModel extends AbstractModel
{
    /**
     *
     */
    const TABLE = 'venues';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
