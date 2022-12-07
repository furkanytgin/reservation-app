<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Table;
use App\Enums\TableStatus;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{

    public function step_one(Request $request){
        $reservation = $request->session()->get('reservation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('reservations.step-one', compact('reservation', 'min_date', 'max_date'));
    }

    public function store_step_one(Request $request){

        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'tel_number' => ['required'],
            'res_date' => ['required' , 'date', new DateBetween, new TimeBetween],
            'guest_number' => ['required'],
        ]);

        if(empty($request->session()->get('reservation'))){
            $reservation = new Reservation;
            //reservation nesnesine validatedi gönderiyoruz
            $reservation->fill($validated);
            //oturuma reservation isminde $reservationu kullanarak veri depoluyoruz step-two'dan döndüğünde verileri yerinde görmesi için.
            $request->session()->put('reservation', $reservation);
        }else{
            //eğer request sessionda reservation boş değilse çağırıyoruz
            $reservation = $request->session()->get('reservation');
            //validatedten geçenleri fill ile gönderiyoruz
            $reservation->fill($validated);
            //oturuma reservation isminde $reservationu kullanarak veri depoluyoruz step-two'dan döndüğünde verileri yerinde görmesi için.
            $request->session()->put('reservation', $reservation);
        }

        return to_route('reservations.step-two');
    }

    public function step_two(Request $request){
        $reservation = $request->session()->get('reservation');
        //rest_date tarihine göre sırala
        $res_table_ids = Reservation::orderBy('res_date')->get()->filter(function ($value) use($reservation){
            // reservation değişkenini kullan eğer Reservation modelinde ki rest_date ile  sessiondaki aynı ise
            // Tablodaki sadece table_id i $res_table_ids değişkneni gönder.
            return $value->res_date->format('Y-m-d') == $reservation->res_date->format('Y-m-d');
        })->pluck('table_id');

        //Table deki status ile TableStatus::AValiable Olanlar
        //guest_numberı sessiondaki istekten büyük yada eşit olan tablolar
        //ve Table daki id ile res_table_ids eşit olmayanları getir.
        $tables = Table::where('status' , TableStatus::Avaliable)
                    ->where('guest_number', '>=', $reservation->guest_number)
                    ->whereNotIn('id', $res_table_ids)
                    ->get();
        return view('reservations.step-two', compact('reservation', 'tables'));
    }

    public function store_step_two(Request $request){

        $validated = $request->validate([
            'table_id' => ['required'],
        ]);
        //eğer request sessionda reservation boş değilse çağırıyoruz
        $reservation = $request->session()->get('reservation');
        //validatedten geçenleri fill ile gönderiyoruz
        $reservation->fill($validated);
        $reservation->save();
        //sesiondaki  reservationı unutuyoruz.
        $request->session()->forget('reservation');

        return to_route('home.website')->with('success', 'Your reservation has been created, thank you for choosing us.');
}

}
