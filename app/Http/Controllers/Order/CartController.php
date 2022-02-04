<?php

namespace App\Http\Controllers\Order;

use App\Models\Order\Cart;
use Illuminate\Http\Request;
use App\Models\Screencast\Playlist;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Order\CartResource;

class CartController extends Controller
{
    public function index()
    {
        return CartResource::collection(Auth::user()->carts()->with('playlist', 'user')->latest()->get());
    }

    public function store(Playlist $playlist)
    {
        if (!Auth::user()->alreadyInCart($playlist)) {
            $cart = Auth::user()->addToCart($playlist);
    
            return response()->json([
                'message' => 'Added to cart',
                'data' => $cart,
            ]);
        } else {
            return response()->json([
                'message' => 'Playlist is already in the cart',
            ], 422);
        }
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json([
            'message' => 'Your cart has been removed',
        ]);
    }
}
