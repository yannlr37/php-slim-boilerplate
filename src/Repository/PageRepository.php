<?php

namespace Sheepdev\Repository;

use Sheepdev\DBAL\AbstractRepository;
use Sheepdev\Logger\AppLogger;
use Sheepdev\Normalizer\PageNormalizer;

class PageRepository extends AbstractRepository
{
    public const TABLE = 'pages';

    public function __construct(
        PageNormalizer $normalizer,
        AppLogger $logger
    ) {
        parent::__construct($normalizer, $logger);
    }
}