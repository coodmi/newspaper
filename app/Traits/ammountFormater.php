<?php

namespace App\Traits;

trait ammountFormater
{
    /**
     * Format a number into South Asian format (e.g., 12,50,000)
     * Optionally converts digits to Bengali.
     *
    //  * @param float|int $number
    //  * @param bool $convertToBengali
    //  * @return string
     */
    public function formatLakh($number, $convertToBengali = false)
    {
        if (!is_numeric($number)) {
            return $number;
        }

        $number_string = (string)$number;
        $decimal_part = '';

        if (strpos($number_string, '.') !== false) {
            list($integer_part, $decimal_part) = explode('.', $number_string);
            $decimal_part = '.' . $decimal_part;
        } else {
            $integer_part = $number_string;
        }

        $length = strlen($integer_part);

        if ($length < 4) {
            $formatted_number = $integer_part . $decimal_part;
        } else {
            $last_three_digits = substr($integer_part, -3);
            $other_digits = substr($integer_part, 0, -3);
            $formatted_number = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $other_digits);
            $formatted_number .= ',' . $last_three_digits . $decimal_part;
        }

        if ($convertToBengali) {
            $english_digits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            $bengali_digits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            return str_replace($english_digits, $bengali_digits, $formatted_number);
        }

        return $formatted_number;
    }
}