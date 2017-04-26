<?php

namespace Validator\Constraints;


class PasswordRepeat implements ConstraintInterface
{
    /**
     * {@inheritdoc}
     */
    public static function isValid($value)
    {
        return $value[0] === $value[1];
    }

    /**
     * {@inheritdoc}
     */
    public static function getErrorMessage()
    {
        return 'Password fields are mismatch.';
    }


}