<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

class FindController extends Controller
{
    public function find()
    {
        return view('pages.find');
    }

    function show(Request $request)
    {

        $from = $request->input('from');
        $to = $request->input('to');
        $journeyDate = $request->input('date');

        $trips = Trip::where('from', $from)
            ->where('to', $to)
            ->where('journey_date', $journeyDate)
            ->get();
        return view('pages.show', compact('trips'));
    }
}
