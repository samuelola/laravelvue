<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookable;

class BookableAvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $data = $request->validate([
            'from' => 'required|date_format:Y-m-d|after_or_equal:now',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from'
        ]);
        
        $bookable = Bookable::findOrFail($id);
        
       return $bookable->availableFor($data['from'], $data['to'])
         ? response()->json([])
         : response()->json([], 404)
        ;
    }
}
