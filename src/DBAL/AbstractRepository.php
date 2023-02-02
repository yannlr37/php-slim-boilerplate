<?php

namespace Sheepdev\DBAL;

use PDO;
use Sheepdev\Logger\AppLogger;
use Sheepdev\Normalizer\AbstractNormalizer;

abstract class AbstractRepository
{
    public const TABLE = '';

    private DBConnection $db;
    protected AbstractNormalizer $normalizer;
    protected AppLogger $logger;

    public function __construct(
        AbstractNormalizer $normaliser,
        AppLogger $logger
    ){
        $this->db = DBConnection::getInstance();
        $this->normalizer = $normaliser;
        $this->logger = $logger;
    }

    public function getAll(): array
    {
        $items = [];
        try {
            $query = sprintf("SELECT * FROM %s", static::TABLE);
            $items = $this->fetch($query);
            $objects = array();
            foreach ($items as $item) {
                $objects[] = $this->normalizer->denormalize($item);
            }
            return $objects;
        } catch (\PDOException $e) {
            $this->logger->error($e->getMessage());
        }
        return $items;
    }

    public function getById(int $id): ?Entity
    {
        $entity = null;
        try {
            $query = sprintf("SELECT * FROM %s WHERE id = %d", static::TABLE, $id);
            $object = $this->fetchOne($query);
            if (empty($object)) {
                return null;
            }
            $entity = $this->normalizer->denormalize($object);
        } catch (\PDOException $e) {
            $this->logger->error($e->getMessage());
        }
        return $entity;
    }

    public function save(Entity $entity): bool
    {
        if (is_null($entity->getId())) {
            return $this->add($entity);
        } else {
            return $this->update($entity);
        }
    }

    public function add(Entity $entity): bool
    {
        try {
            $query = $this->buildAddQuery($entity);
            $stmt = $this->db->pdo->prepare($query);
            return $stmt->execute();
        } catch (\PDOException $e) {
            $context = [];
            $this->logger->error('[Add] ' . $e->getMessage(), $context);
            return false;
        }
    }

    public function update(Entity $entity): bool
    {
        try {
            $query = $this->buildUpsertQuery($entity);
            $stmt = $this->db->pdo->prepare($query);
            return $stmt->execute();
        } catch (\PDOException $e) {
            $context = [];
            $this->logger->error('[Update] ' . $e->getMessage(), $context);
            return false;
        }
    }

    public function delete(int $entityId): bool
    {
        try {
            $query = sprintf("DELETE FROM %s WHERE id = %d", static::TABLE, $entityId);
            $stmt = $this->db->pdo->prepare($query);
            return $stmt->execute();
        } catch (\PDOException $e) {
            $context = [];
            $this->logger->error('[Delete] ' . $e->getMessage(), $context);
            return false;
        }
    }

    public function getLastInsertedId(): int
    {
        return (int) $this->db->pdo->lastInsertId(static::TABLE);
    }

    private function buildAddQuery(Entity $entity): string
    {
        $data = $entity->getFields();
        return sprintf(
            "INSERT INTO %s (`%s`) VALUES ('%s')",
            static::TABLE,
            implode("`, `", array_keys($data)),
            implode("', '", array_values($data))
        );
    }

    private function buildUpsertQuery(Entity $entity): string
    {
        $data = $entity->getFields();
        $update_values = [];
        foreach ($data as $key => $value) {
            $update_values[] = sprintf("%s = '%S'", $key, $value);
        }
        return sprintf(
            "INSERT INTO %s (`%s`) VALUES ('%s') ON DUPLICATE KEY UPDATE %s",
            static::TABLE,
            implode("`, `", array_keys($data)),
            implode("', '", array_values($data)),
            implode(', ', $update_values)
        );
    }

    private function fetch(string $query): array
    {
        $stmt = $this->db->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function fetchOne(string $query): array
    {
        $stmt = $this->db->pdo->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return [];
        }
        return $data;
    }
}