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
    }
    public function getUserShow(int $user_id, $show_id = null)
    {
        // In case we don't precise the show_id
        if (!$show_id) {
            $statement = $this
                ->pdo
                ->prepare(
                    "SELECT
                b.ref_id AS showId,
                b.ref AS showName,  
                b.type AS ticketType,
                c.title AS showTitle,
                c.show_start AS showStart,
                c.id AS showId
                FROM bookings AS b
                LEFT JOIN candy_show AS c ON c.id = b.ref_id
                WHERE b.id_user = ?"
                );
            $values = [$user_id];
        } else {
            $statement = $this
                ->pdo
                ->prepare(
                    "SELECT
                b.ref_id AS showId,
                b.ref AS showName,  
                b.type AS ticketType,
                c.title AS showTitle,
                c.show_start AS showStart,
                c.id AS showId
                FROM bookings AS b
                LEFT JOIN candy_show AS c ON c.id = b.ref_id
                WHERE b.id_user = ?
                AND b.ref_id = ?"
                );
            $values = [$user_id, $show_id];
        }

        $statement->execute($values);
        return $statement->fetchAll();
    }
}
