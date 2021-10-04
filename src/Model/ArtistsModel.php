<?php

namespace App\Model;

class ArtistsModel extends AbstractModel
{
    /**
     *
     */
    const TABLE = 'artists';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
