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
}
