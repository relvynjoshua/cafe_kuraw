<?php
if (!function_exists('generateOTP')) {
    function generateOTP($length = 6) {
        return str_pad(random_int(0, 999999), $length, '0', STR_PAD_LEFT);
    }
}