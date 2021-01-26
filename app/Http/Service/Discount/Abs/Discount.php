<?php

namespace App\Http\Service\Discount\Abs;

use App\Http\Service\Cart\Cart;
use App\Http\Service\Product\Product;
use Exception;

abstract class Discount
{
    abstract public function run_rule(Cart $cart);

    abstract public function create_discount_product() : Product;

    private function verify() : void
    {
        try
        {
            foreach (get_object_vars($this) as $key => $value)
            {
                if ( empty($this->$key) )
                {
                    throw new Exception("Not Found " . $key . " in " . static::class . " class.");
                }
            }
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function filter(Cart $cart) : void
    {
        $this->verify();
        $cart->del_discount_product(static::class);
        $this->run_rule($cart);
    }
}
