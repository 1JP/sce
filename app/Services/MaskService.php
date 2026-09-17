<?php

namespace App\Services;

class MaskService
{
    public static function applyMask(string $value, string $mask): string
    {
        $masked = '';
        $k = 0;

        for ($i = 0; $i < strlen($mask); $i++) {
            if ($mask[$i] === '#') {
                if (isset($value[$k])) {
                    $masked .= $value[$k++];
                } else {
                    break;
                }
            } else {
                $masked .= $mask[$i];
            }
        }

        return $masked;
    }
}