<?php

namespace App\Http\Service\Discount\Abs;

use App\Http\Service\Cart\Cart;
use App\Http\Service\Product\Product;

abstract class Discount_get_3_free_1 extends Discount
{
    protected $discount_product_name = "";
    protected $get_free_id           = null;

    public function run_rule(Cart $cart) : void
    {
        $count_coder_at_work = $cart->get_quantity($this->get_free_id);
        $free_count          = ($count_coder_at_work >= 3) ? floor($count_coder_at_work / 3) : 0;

        if ( $free_count )
        {
            for ($i = 0; $i < $free_count; $i++)
            {
                $cart->add_product($this->create_discount_product());
            }
        }
    }

    public function create_discount_product() : Product
    {
        // TODO 改成靜態物件
        return (new product($this->get_free_id))
            ->set_price(config("product.{$this->get_free_id}.price") * -1)
            ->set_name($this->discount_product_name)
            ->set_discount_class_name(static::class)
            ->set_discount_product(true);
    }
}
