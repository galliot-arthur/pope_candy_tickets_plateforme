<?php

namespace App\Model;

class BookingsModel extends AbstractModel
{
    /**
     *
     */
    const TABLE = 'bookings';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
