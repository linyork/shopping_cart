<?php

namespace App\Http\Service\Discount\Abs;

use App\Http\Service\Cart\Cart;
use App\Http\Service\Product\Product;

abstract class Discount_get_10_get_discount extends Discount
{
    protected $discount_product_name = "";
    protected $get_10_id             = null;
    protected $get_discount_price    = 0;

    public function run_rule(Cart $cart) : void
    {
        if ( $cart->get_quantity($this->get_10_id) >= 10 )
        {
            foreach ($cart->get_items() as $item)
            {
                if ( $item->get_id() == $this->get_10_id )
                {
                    $cart->add_product($this->create_discount_product());
                }
            }
        }
    }

    public function create_discount_product() : Product
    {
        // TODO 改成靜態物件
        return (new product($this->get_10_id))
            ->set_price((config("product.{$this->get_10_id}.price") - $this->get_discount_price) * -1)
            ->set_name($this->discount_product_name)
            ->set_discount_class_name(static::class)
            ->set_discount_product(true);
    }
}
