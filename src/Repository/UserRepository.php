<?php

namespace Sheepdev\Repository;

use Sheepdev\DBAL\AbstractRepository;
use Sheepdev\Logger\AppLogger;
use Sheepdev\Normalizer\UserNormalizer;

class UserRepository extends AbstractRepository
{
    public const TABLE = 'users';

    public function __construct(
        UserNormalizer $normalizer,
        AppLogger $logger
    ) {
        parent::__construct($normalizer, $logger);
    }
}