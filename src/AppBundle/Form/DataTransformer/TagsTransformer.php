<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class TagsTransformer implements DataTransformerInterface
{
    public function transform($tags)
    {
        return $tags ? implode(' ', $tags) : "";
    }

    public function reverseTransform($tagsString)
    {
        $tagsString = preg_replace('/\s+/', ' ', trim($tagsString));

        return explode(' ', $tagsString);
    }
}
