<?php

namespace Validator\Constraints;


class NotEmpty implements ConstraintInterface
{
    /**
     * {@inheritdoc}
     */
    public static function isValid($value)
    {
        return !empty($value);
    }

    /**
     * {@inheritdoc}
     */
    public static function getErrorMessage()
    {
        return 'This field should not be blank';
    }


}