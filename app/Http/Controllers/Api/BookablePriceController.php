<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookable;
use Carbon\Carbon;

class BookablePriceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id,Request $request)
    {
        $bookable = Bookable::findOrFail($id);
        $data = $request->validate([
            'from'=>'required|date_format:Y-m-d',
            'to'  => 'required|date_format:Y-m-d|after_or_equal:from'
        ]);

        $days = (new Carbon($data['from']))->diffInDays(new Carbon($data['to'])) + 1;
        $price = $days * $bookable->price;
        return response()->json([
            'data'=>[
                'total_booking_price' => $price,
                'breakdown' => [
                    'bookable_price'=>$bookable->price,
                    'days_interval' => $days
                ]
            ]
        ]);
    }
}
