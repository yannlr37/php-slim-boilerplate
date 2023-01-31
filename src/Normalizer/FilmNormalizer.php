<?php

namespace Sheepdev\Normalizer;

use Sheepdev\Entity\Film;

class FilmNormalizer extends AbstractNormalizer
{
    public function denormalize(array $data)
    {
        return $this->serializer->denormalize($data, Film::class);
    }
}