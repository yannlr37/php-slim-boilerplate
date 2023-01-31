<?php

namespace Sheepdev\Normalizer;

use DateTime;
use Sheepdev\Entity\User;

class UserNormalizer extends AbstractNormalizer
{
    public function denormalize(array $data)
    {
        $data = $this->formatFields($data);
        return $this->serializer->denormalize($data, User::class);
    }

    private function formatFields(array $data): array
    {
        array_walk($data, function(&$item, $key) {
            if (in_array($key, ['created_at', 'updated_at'])) {
                $item = new DateTime($item);
            }
        });
        return $data;
    }
}