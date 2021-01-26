<?php

namespace App\Http\Service\Discount\Abs;

use App\Http\Service\Cart\Cart;
use App\Http\Service\Product\Product;
use App\Exceptions\PromotionsException;

abstract class Discount
{
    abstract public function run_rule(Cart $cart);

    abstract public function create_discount_product() : Product;

    private function verify() : void
    {
        foreach (get_object_vars($this) as $key => $value)
        {
            if ( empty($this->$key) )
            {
                throw new PromotionsException("Undefined [\$this->" . $key . "] in [" . static::class . "] class.");
            }
        }
    }

    public function filter(Cart $cart) : void
    {
        $this->verify();
        $cart->del_discount_product(static::class);
        $this->run_rule($cart);
    }
}
