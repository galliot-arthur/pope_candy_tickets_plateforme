<?php

namespace App\Model;

class ImagesModel extends AbstractModel
{
    /**
     *
     */
    const TABLE = 'images';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
