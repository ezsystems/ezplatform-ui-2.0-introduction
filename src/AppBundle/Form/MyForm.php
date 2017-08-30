<?php

namespace AppBundle\Form;

use eZ\Publish\API\Repository\Values\ValueObject;

class MyForm extends ValueObject
{
    /**
     * @var int
     */
    public $locationId;
}
