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
            "UPDATE %s SET sessionToken = '%s' WHERE id = %d",
            self::TABLE,
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
        return $this->getOneBy(['sessionToken' => $userSessionToken]);
    }

    public function getUserByEmailAndPassword(string $email, string $password)
    {
        return $this->getOneBy([
            'email' => $email,
            'password' => $password
        ]);
    }

}