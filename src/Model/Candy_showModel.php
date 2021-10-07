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

    public function allShowsWithArtist(): array
    {
        return $this
            ->pdo
            ->query(
                "SELECT candy_show.id,
                candy_show.title,
                candy_show.venue, 
                candy_show.first_part, 
                candy_show.price, 
                candy_show.show_start, 
                candy_show.show_end, 
                candy_show.sales_on, 
                candy_show.sold_out, 
                candy_show.sales, 
                artists.name AS artist_name, 
                artists.biography AS artist_biography, 
                artists.website AS artist_website,
                venues.capacity AS capacity
                FROM candy_show
                LEFT JOIN venues ON candy_show.venue = venues.id
                LEFT JOIN artists ON candy_show.first_part = artists.id
                ORDER BY show_start"
            )
            ->fetchAll();
    }
}