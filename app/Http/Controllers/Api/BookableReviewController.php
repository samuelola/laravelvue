<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookable;
use App\Http\Resources\BookableReviewIndexResource;

class BookableReviewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$id)
    {
        $bookable = Bookable::findOrFail($id);
        return BookableReviewIndexResource::collection($bookable->reviews()->latest()->get());
    }
}
