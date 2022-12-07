<?php

namespace App\Rules;

use Illuminate\Support\Carbon;
use Illuminate\Contracts\Validation\Rule;

class TimeBetween implements Rule
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
        //İnputa girilen $value yu Carbon tipinde alıyoruz.
        $pickupDate = Carbon::parse($value);
        // input alınına girilen tarihinin saat dakika saniye sini $pickupTime değişkenine atıyoruz ör: 15::25:32
        $pickupTime = Carbon::createFromTime($pickupDate->hour, $pickupDate->minute, $pickupDate->second);
        //restorantın açık olduğu saatleri yazıyoruz.
        $earliestTime = Carbon::createFromTimeString('12:00:00');
        $lastTime  = Carbon::createFromTimeString('20:00:00');

        return $pickupTime->between($earliestTime, $lastTime) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please choose the time between 12:00 - 20:00';
    }
}
