<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class PurchasedController extends Controller
{
    function purchased()
    {

        $customers = Customer::with('trip', 'seats')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($customers) {

            return view('pages.purchased', compact('customers'));
        } else {

            return redirect()->route('error.page');
        }
    }

    public function purchasedDelete($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        $trip = $customer->trip;

        if (!$trip) {
            return redirect()->back()->with('error', 'Trip not found for the customer');
        }

        $seatNumbersString = $customer->seats->pluck('seat_number')->implode(',');

        $seats = explode(',', $seatNumbersString);

        $trip->increment('total_seats', count($seats));

        $customer->seats()->delete();

        $customer->delete();

        return redirect()->route('bus.purchased-ticket')->with('success', 'Customer and associated seats deleted successfully');
    }
}
