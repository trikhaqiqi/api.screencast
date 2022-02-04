<?php

namespace App\Http\Controllers\Screencast;

use Illuminate\Http\Request;
use App\Models\Screencast\Playlist;
use App\Http\Controllers\Controller;

class CheckIfUserHasBoughtSeriesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Playlist $playlist)
    {
        return response()->json([
            'data' => $request->user()->hasBought($playlist),
        ]);
    }
}
