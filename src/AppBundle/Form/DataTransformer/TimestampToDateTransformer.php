<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class TimestampToDateTransformer implements DataTransformerInterface
{
    public function transform($timestamp)
    {
        if (null === $timestamp) {
            return null;
        }

        $date = new \DateTime();
        $date->setTimestamp($timestamp);

        return $date;
    }

    public function reverseTransform($date)
    {
        if (null === $date) {
            return null;
        }

        return $date->getTimestamp();
    }
}
