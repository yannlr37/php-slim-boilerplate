<?php

namespace Sheepdev\Repository;

use Sheepdev\DBAL\AbstractRepository;
use Sheepdev\Logger\AppLogger;
use Sheepdev\Normalizer\FilmNormalizer;

class FilmRepository extends AbstractRepository
{
    public function __construct(
      FilmNormalizer $normalizer,
      AppLogger $logger
    ) {
        parent::__construct($normalizer, $logger);
    }
}