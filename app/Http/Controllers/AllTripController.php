<?php

namespace App\Http\Controllers;

use App\Models\Trip;


class AllTripController extends Controller
{
    function all_trip()
    {

        $trips = Trip::orderBy('created_at', 'desc')->paginate(10);

        return view('pages.all_trip', compact('trips'));
    }

    public function deleteTrip($id)
    {
        $trip = Trip::find($id);

        if (!$trip) {
            return redirect()->back()->with('error', 'Trip not found');
        }

        $trip->delete();

        return redirect()->route('bus.all-trip')->with('success', 'Trip deleted successfully');
    }
}
