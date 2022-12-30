<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use App\Enums\TableStatus;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::orderBy('created_at', 'desc')->get();
        // eğer geçmişteki değilde sadece bugün ve sonraki reservasyonları görmek istersen admin tarafında
        //->where('res_date', '<=', now()) bunu kullan.
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = Table::where('status', TableStatus::Avaliable)->get();
        return view('admin.reservations.create', compact('tables'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request)
    {
        $table = Table::findOrFail($request->table_id);
        //eğer tabledaki guest numberdan büyük ise rezervayson daki guest_number hata mesajı verir.
        if($request->guest_number > $table->guest_number){
            return back()->with('warning', 'Please chose the table base on guests.');
        }
        $request_date = Carbon::parse($request->res_date);
        foreach($table->reservations as $res){
            if($res->res_date->format('Y-m-d') == $request_date->format('Y-m-d')){
                return back()->with('warning', 'This table is reserved for this date.');
            }
        }

        Reservation::create($request->validated());

        return to_route('admin.reservations.index')->with('success' , 'Reservation successfully created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $tables = Table::where('status', TableStatus::Avaliable)->get();

        return view('admin.reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationStoreRequest $request, Reservation $reservation)
    {
        $table = Table::findOrFail($request->table_id);
        //eğer tabledaki guest numberdan büyük ise rezervayson daki guest_number hata mesajı verir.
        if($request->guest_number > $table->guest_number){
            return back()->with('warning', 'Please chose the table base on guests.');
        }
        $request_date = Carbon::parse($request->res_date);
        // $table daki reservationslardan id si edit olana eşit olmayanları getir.
        $reservations = $table->reservations()->where('id', '!=', $reservation->id)->get();
        //eğer bu table a aynı tarihte res yapan varsa hata mesajı döndür.
        foreach($reservations as $res){
            if($res->res_date->format('Y-m-d') == $request_date->format('Y-m-d')){
                return back()->with('warning', 'This table is reserved for this date.');
            }
        }

        $reservation->update($request->validated());

        return to_route('admin.reservations.index')->with('success' , 'Reservation successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return to_route('admin.reservations.index')->with('danger' , 'Reservation successfully deleted!');
    }
}
