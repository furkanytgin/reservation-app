<?php

namespace App\Rules;

use Illuminate\Support\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateBetween implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // $value ya girilen saati carbon tipinde alıyoruz
        $pickupDate = Carbon::parse($value);
        // şuan ki zamana bir hafta ekliyoruz en fazla 1 hafta sonrasına rezeryasyon için
        $lastDate = Carbon::now()->addWeek();

        //eğer değer şuandan büyük veya eşitse VE $lastDate'ten küçük veya eşitse döndür.
        return $value >= now() && $value <= $lastDate;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please Chooice the date between a week from now';
    }
}
