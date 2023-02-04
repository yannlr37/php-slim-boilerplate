<?php

namespace Sheepdev\Entity;

use DateTime;
use Sheepdev\DBAL\Entity;

class Page extends Entity
{
    /** @var string */
    private $slug;
    /** @var string */
    private $title;
    /** @var string */
    private $content;
    /** @var int */
    private $author;
    /** @var int */
    private $reviewer;
    /** @var DateTime */
    private $date;
}