<?php

namespace Validator\Constraints;

interface ConstraintInterface
{
    /**
     * @param mixed $value
     *
     * @return bool Value is valid.
     */
    public static function isValid($value);

    /**
     * @return string
     */
    public static function getErrorMessage();
}