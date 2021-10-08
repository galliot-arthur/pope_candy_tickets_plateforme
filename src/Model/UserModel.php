<?php

namespace App\Model;

class UserModel extends AbstractModel
{
    /**
     *
     */
    const TABLE = 'user';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * Help the login session by finding user by Name Or Email
     *
     * @param string $userId
     * @return void
     */
    public function findByNameOrEmail(string $userId)
    {
        $statement = $this
            ->pdo
            ->prepare(
                "SELECT *
                FROM $this->table
                WHERE firstname = ?  OR email = ?"
            );
        $statement->execute([$userId, $userId]);
        return $statement->fetch();
    }


    /**
     * Affiche toutes les valeurs d'une table.
     *
     * @return array
     */
    public function selectBookingByUser(): array
    {
        return $this
            ->pdo
            ->query(
                "SELECT
                u.id,
                u.name,
                u.email,
                u.password,
                u.firstname,
                u.adress,
                u.age,
                u.acces_right,
                u.admin, 
                b.ref_id AS showId, 
                b.ref AS showName,  
                b.type AS ticketType
                FROM user AS u
                LEFT JOIN bookings AS b ON b.id_user = u.id"
            )
            ->fetchAll();
    }
}
