<?php

namespace Validator;


use Validator\Constraints\ConstraintInterface;

class Validator
{
    /**
     * @param $value
     * @param ConstraintInterface[] $constraints
     * @return string|null Null or error message.
     */
    public static function validate($value, array $constraints)
    {
        foreach ($constraints as $constraint) {
            if(!$constraint::isValid($value)) {
                return $constraint::getErrorMessage();
            }
        }
        return null;
    }
}