<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Seat;
use App\Models\Trip;

use Illuminate\Http\Request;

class BusTicketController extends Controller
{

    public function buy(Request $request)
    {
        $busCode = $request->input('bus_code');
        $paribahanName = $request->input('paribahan_name');
        $availableSeats = $request->input('available_seats');

        $id = $busCode;
        $trip = Trip::find($id)->all();

        $seatNumbersString = Seat::where('trip_id', $busCode)->pluck('seat_number')->implode(',');


        $seatNumbers = explode(',', $seatNumbersString);

        return view('pages.buy', compact('paribahanName', 'availableSeats', 'busCode', 'seatNumbers'));
    }

    public function submit_buy(Request $request)
    {

        $busCode = $request->query('busCode');
        $customer = Customer::create([
            'customer_name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'trip_id' => $busCode,
        ]);

        $selectedSeatNumbers = $request->input('seat_numbers');
        $selectedSeatsArray = [];

        foreach ($selectedSeatNumbers as $seatNumber) {
            $selectedSeatsArray[] = $seatNumber;
        }

        $seatNumbersString = implode(',', $selectedSeatsArray);


        $trip = Trip::find($busCode);
        $totalSeats = count($selectedSeatNumbers);
        $ticketPrice = $trip->ticket_price;
        $totalPrice = $totalSeats * $ticketPrice;

        $trip = Trip::where('id', $busCode)->pluck('paribahan_name')->first();
        $paribahanName = $trip;
        Seat::create([
            'customer_id' => $customer->id,
            'trip_id' => $busCode,
            'bus_name' => $paribahanName,
            'seat_number' => $seatNumbersString,
            'total_price' => $totalPrice,
        ]);

        $trip = Trip::find($busCode);
        $trip->decrement('total_seats', count($selectedSeatNumbers));

        return redirect()->route('bus.purchased-ticket');
    }
}
