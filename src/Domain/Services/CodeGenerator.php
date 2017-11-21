<?php

namespace Webbala\Domain\Services;

class CodeGenerator
{
    /**
     * @param int $length
     * @param string $characters
     * @return string
     */
    public function generate($length = 8, $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        $str = '';
        $max = mb_strlen($characters, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $characters[random_int(0, $max)];
        }
        return $str;
    }
}