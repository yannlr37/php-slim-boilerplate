<?php

namespace Sheepdev\Entity;

use DateTime;
use Sheepdev\DBAL\Entity;

class Page extends Entity
{
    private string $slug;
    private string $title;
    private string $content;
    private int $author;
    private int $reviewer;
    private DateTime $date;
}