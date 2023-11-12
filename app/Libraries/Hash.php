<?php


namespace App\Libraries;

class Hash
{

    public static function encrypt($string)
    {
        return password_hash($string, PASSWORD_BCRYPT);
    }
}