<?php

namespace App;

use App\Models\Product;

class Helper
{
    public static function verificarExpiracionCarrito($id)
    {
        $expiryTime = session('cart_expiry_time');
        if ($expiryTime && now() > $expiryTime) {
            $carrito = new Carrito();
            $cantidadDevuelta = $carrito->eliminar($id);

            $product = Product::find($id);

            if ($product) {
                $product->stock += $cantidadDevuelta;
                $product->save();
            }
        }
    }

    public static function verificarExpiracionCarritoOne($id)
    {
        $expiryTime = session('cart_expiry_time_one');
        if ($expiryTime && now() > $expiryTime) {
            $carrito = new Carrito();
            $cantidadDevuelta = $carrito->eliminar($id);

            $product = Product::find($id);

            if ($product) {
                $product->stock += $cantidadDevuelta;
                $product->save();
            }
        }
    }

    public static function verificarSinExpiracionCarrito($id)
    {
        $carrito = new Carrito();
        $cantidadDevuelta = $carrito->eliminar($id);

        $product = Product::find($id);

        if ($product) {
            $product->stock += $cantidadDevuelta;
            $product->save();
        }
    }

    public static function verificarSnExpiracionCarritoOne($id)
    {
        $carrito = new Carrito();
        $cantidadDevuelta = $carrito->eliminar($id);

        $product = Product::find($id);

        if ($product) {
            $product->stock += $cantidadDevuelta;
            $product->save();
        }
    }
}
