<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF): bool
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    public static function phone($value, $digit = 10)
    {
        return preg_match('/^\d{' . $digit . '}$/', $value);
    }
    public static function confirmPassword($password, $confirm_password): bool
    {
        return $password == $confirm_password;
    }
}
