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


    /**
     * Affiche toutes les valeurs d'une table.
     *
     * @return array
     */
    public function selectPricesWithVenues(): array
    {
        return $this
            ->pdo
            ->query(
                "SELECT 
                p.id,
                p.venue_id, 
                p.price, p.ticket_type, 
                v.title AS venueTitle, 
                v.town AS town,
                v.address AS venue_address
                FROM prices AS p
                LEFT JOIN venues AS v ON v.id = p.venue_id"
            )
            ->fetchAll();
    }
}
