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


    public function selectBookingByUser(int $userId)
    {
            $statement = $this
            ->pdo
            ->prepare(
                "SELECT
                *
                FROM $this->table
                WHERE id_user = ?"
            );
        $statement->execute([$userId]);
        return $statement->fetchAll();
    }
}

