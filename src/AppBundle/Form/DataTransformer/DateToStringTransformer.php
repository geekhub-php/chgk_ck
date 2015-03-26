<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateToStringTransformer implements DataTransformerInterface
{
    const DATE_FORMAT = 'd.m.Y';

    public function transform($date)
    {
        if (null === $date) {
            return "";
        }

        return $date->format(self::DATE_FORMAT);
    }

    public function reverseTransform($string)
    {
        if ($string === "") {
            return null;
        }

        $date = \DateTime::createFromFormat(self::DATE_FORMAT, $string);

        if ($date) {
            $date->setTime(0, 0, 0);
            return $date;
        } else {
            throw new TransformationFailedException('invalid date');
        }
    }
}
