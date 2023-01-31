<?php

namespace Sheepdev\Normalizer;

use Sheepdev\Entity\Page;

class PageNormalizer extends AbstractNormalizer
{
    public function denormalize(array $data)
    {
        return $this->serializer->denormalize($data, Page::class);
    }
}