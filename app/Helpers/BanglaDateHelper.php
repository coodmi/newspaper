<?php

namespace App\Helpers;

use Carbon\Carbon;

class BanglaDateHelper
{
    /**
     * Converts English numbers to Bengali numbers.
     */
    public static function convertToBanglaNumber(string $number): string
    {
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bn = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($en, $bn, $number);
    }

    /**
     * Converts English weekday to Bengali weekday.
     */
    public static function banglaWeekday(string $weekday): string
    {
        return [
            'Saturday' => 'শনিবার',
            'Sunday' => 'রবিবার',
            'Monday' => 'সোমবার',
            'Tuesday' => 'মঙ্গলবার',
            'Wednesday' => 'বুধবার',
            'Thursday' => 'বৃহস্পতিবার',
            'Friday' => 'শুক্রবার',
        ][$weekday] ?? $weekday;
    }

    /**
     * Converts English month name to Bengali month name.
     */
    public static function banglaMonth(string $month): string
    {
        return [
            'January' => 'জানুয়ারি',
            'February' => 'ফেব্রুয়ারি',
            'March' => 'মার্চ',
            'April' => 'এপ্রিল',
            'May' => 'মে',
            'June' => 'জুন',
            'July' => 'জুলাই',
            'August' => 'আগস্ট',
            'September' => 'সেপ্টেম্বর',
            'October' => 'অক্টোবর',
            'November' => 'নভেম্বর',
            'December' => 'ডিসেম্বর',
        ][$month] ?? $month;
    }

    /**
     * First line: ঢাকা, শুক্রবার ২০ জুন ২০২৫
     */
    public static function formattedLineOne(?Carbon $date = null): string
    {
        $date = $date ?? Carbon::now('Asia/Dhaka');
        $weekday = self::banglaWeekday($date->format('l'));
        $day = self::convertToBanglaNumber($date->format('d'));
        $month = self::banglaMonth($date->format('F'));
        $year = self::convertToBanglaNumber($date->format('Y'));
        return "ঢাকা, {$weekday} {$day} {$month} {$year}";
    }

    /**
     * Calculates the accurate Bengali date from a Gregorian date.
     * This is the corrected custom function without any external package.
     */
    private static function getCustomBanglaDate(Carbon $date): array
    {
        $gregorianYear = (int)$date->format('Y');
        $gregorianMonth = (int)$date->format('m');
        $gregorianDay = (int)$date->format('d');

        if ($gregorianMonth < 4 || ($gregorianMonth === 4 && $gregorianDay < 14)) {
            $startYear = $gregorianYear - 1;
            $bengaliYear = $startYear - 593;
        } else {
            $startYear = $gregorianYear;
            $bengaliYear = $startYear - 593;
        }

        $bengaliNewYear = Carbon::create($startYear, 4, 14, 0, 0, 0, 'Asia/Dhaka');
        $isLeapYear = Carbon::create($bengaliYear + 594, 2, 1)->isLeapYear();

        $bengaliMonths = ['বৈশাখ', 'জ্যৈষ্ঠ', 'আষাঢ়', 'শ্রাবণ', 'ভাদ্র', 'আশ্বিন', 'কার্তিক', 'অগ্রহায়ণ', 'পৌষ', 'মাঘ', 'ফাল্গুন', 'চৈত্র'];
        $bengaliMonthDays = [31, 31, 31, 31, 31, 30, 30, 30, 30, 30, $isLeapYear ? 31 : 30, 30];

        // We use ->startOfDay() to ignore time and prevent float results.
        $daysPassed = $bengaliNewYear->startOfDay()->diffInDays($date->startOfDay());

        $bengaliMonthIndex = 0;
        $tempDays = $daysPassed;

        foreach ($bengaliMonthDays as $index => $daysInMonth) {
            if ($tempDays < $daysInMonth) {
                $bengaliMonthIndex = $index;
                break;
            }
            $tempDays -= $daysInMonth;
        }
        
        // Using (int) cast to be extra safe.
        $bengaliDay = (int)$tempDays + 1;
        $bengaliMonth = $bengaliMonths[$bengaliMonthIndex];

        return [
            'day' => self::convertToBanglaNumber((string)$bengaliDay),
            'month' => $bengaliMonth,
            'year' => self::convertToBanglaNumber((string)$bengaliYear),
        ];
    }

    /**
     * Second line: ৬ আষাঢ় ১৪৩২, ২৪ জ্বিলহজ্জ ১৪৪৬
     * This function now uses the corrected custom logic.
     */
    public static function formattedLineTwo(?Carbon $date = null): string
    {
        $date = $date ?? Carbon::now('Asia/Dhaka');

        // --- Get accurate Bengali date using our custom function ---
        $banglaDateParts = self::getCustomBanglaDate($date);
        $banglaDateString = "{$banglaDateParts['day']} {$banglaDateParts['month']} {$banglaDateParts['year']}";

        // --- Hijri date using IntlDateFormatter (your original code was correct) ---
        $intl = \IntlDateFormatter::create(
            'bn_BD@calendar=islamic',
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'Asia/Dhaka',
            \IntlDateFormatter::TRADITIONAL,
            'd MMMM y'
        );

        $hijriDate = $intl->format($date->getTimestamp());

        return "{$banglaDateString}, {$hijriDate}";
    }

    /**
     * 3rd line:  শুক্রবার ২০ জুন ২০২৫
     */
    public static function formattedLineThree(?Carbon $date = null): string
    {
        $date = $date ?? Carbon::now('Asia/Dhaka');
        $weekday = self::banglaWeekday($date->format('l'));
        $day = self::convertToBanglaNumber($date->format('d'));
        $month = self::banglaMonth($date->format('F'));
        $year = self::convertToBanglaNumber($date->format('Y'));
        return "{$weekday} {$day} {$month} {$year}";
    }

    /**
     * Four line:  শুক্রবার ২০ জুন ২০২৫
     */
    public static function formattedLineFour(?Carbon $date = null): string
    {
        $date = $date ?? Carbon::now('Asia/Dhaka');
        $day = self::convertToBanglaNumber($date->format('d'));
        $month = self::banglaMonth($date->format('F'));
        return "{$day} {$month}";
    }
}