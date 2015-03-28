<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class TagsTransformer implements DataTransformerInterface
{
    public function transform($tags)
    {
        return implode(' ', $tags);
    }

    public function reverseTransform($tagsString)
    {
        return explode(' ', trim($tagsString));
    }
}