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

    public function setSessionToken(int $userId, string $userSessionToken): void
    {
        $query = sprintf(
            "UPDATE sessionToken FROM %s WHERE id = %d",
            $userSessionToken,
            $userId
        );
        $this->execute($query);
    }

    /**
     * @param $userId
     * @param $userSessionToken
     */
    public function getUserBySessionToken(string $userSessionToken)
    {
        return $this->getOneBy('sessionToken', $userSessionToken);
    }

}