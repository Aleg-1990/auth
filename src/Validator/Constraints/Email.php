<?php

namespace Validator\Constraints;


class Email implements ConstraintInterface
{
    /**
     * {@inheritdoc}
     */
    public static function isValid($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * {@inheritdoc}
     */
    public static function getErrorMessage()
    {
        return 'Email is not valid';
    }


}