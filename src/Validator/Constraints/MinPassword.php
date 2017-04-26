<?php

namespace Validator\Constraints;


class MinPassword implements ConstraintInterface
{
    const MIN_LENGTH = 6;

    /**
     * {@inheritdoc}
     */
    public static function isValid($value)
    {
        return strlen($value) >= self::MIN_LENGTH;
    }

    /**
     * {@inheritdoc}
     */
    public static function getErrorMessage()
    {
        return 'Password is too short';
    }


}