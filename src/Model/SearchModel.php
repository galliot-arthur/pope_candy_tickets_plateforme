<?php

namespace App\Model;

class SearchModel extends AbstractModel
{
    /**
     *
     */
    const TABLE = 'search';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
