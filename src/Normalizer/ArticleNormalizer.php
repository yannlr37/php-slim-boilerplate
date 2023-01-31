<?php

namespace Sheepdev\Normalizer;

use Sheepdev\Entity\Article;

class ArticleNormalizer extends AbstractNormalizer
{
    public function denormalize(array $data)
    {
        return $this->serializer->denormalize($data, Article::class);
    }
}