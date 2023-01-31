<?php

namespace Sheepdev\Repository;

use Sheepdev\DBAL\AbstractRepository;
use Sheepdev\Logger\AppLogger;
use Sheepdev\Normalizer\ArticleNormalizer;

class ArticleRepository extends AbstractRepository
{
    public const TABLE = 'article';

    public function __construct(
        ArticleNormalizer $normalizer,
        AppLogger $logger
    ) {
        parent::__construct($normalizer, $logger);
    }
}