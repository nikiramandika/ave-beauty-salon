<?php

namespace App\Helpers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartManagement
{
    public static function addItemToCart($product_id, $quantity = 1)
    {
        $user_id = Auth::id();
        $cart = Cart::firstOrCreate(
            ['user_id' => $user_id, 'is_active' => true],
            ['is_active' => true]
        );

        $cart_item = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $product_id)
            ->first();

        if ($cart_item) {
            $cart_item->quantity += $quantity;
            $cart_item->save();
        } else {
            $product = Product::findOrFail($product_id);
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }

        return self::getCartItemCount($cart->cart_id);
    }

    public static function incrementItemQuantityByCartItemId($cart_item_id)
    {
        $cart_item = CartItem::find($cart_item_id);
        if ($cart_item) {
            $cart_item->quantity += 1;
            $cart_item->save();
        }
    }

    public static function decrementItemQuantityByCartItemId($cart_item_id)
    {
        $cart_item = CartItem::find($cart_item_id);
        if ($cart_item) {
            if ($cart_item->quantity > 1) {
                $cart_item->quantity -= 1;
                $cart_item->save();
            } else {
                $cart_item->delete();
            }
        }
    }

    public static function removeItemFromCartByCartItemId($cart_item_id)
    {
        CartItem::destroy($cart_item_id);
    }

    public static function getCartItems()
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->where('is_active', true)->first();
        if ($cart) {
            return CartItem::where('cart_id', $cart->cart_id)->with('product')->get();
        }
        return collect();
    }

    public static function getCartItemCount($cart_id)
    {
        return CartItem::where('cart_id', $cart_id)->sum('quantity');
    }

    public static function calculateGrandTotal($items)
    {
        return $items->sum(function ($item) {
            return $item->quantity * ($item->product->price ?? 0);
        });
    }
}
