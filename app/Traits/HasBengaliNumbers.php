<?php

namespace App\Traits;

trait HasBengaliNumbers
{
   protected function convertToBengaliNumbers($text)
   {
      return str_replace(
         ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
         ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'],
         $text
      );
   }

   protected function getBengaliTimeAgo($date)
   {
      return $this->convertToBengaliNumbers(
         \Carbon\Carbon::parse($date)->diffForHumans(['locale' => 'bn'])
      );
   }
}