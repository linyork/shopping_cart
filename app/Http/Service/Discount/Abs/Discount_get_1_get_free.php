<?php

namespace App\Http\Service\Discount\Abs;

use App\Http\Service\Cart\Cart;
use App\Http\Service\Product\Product;

abstract class Discount_get_1_get_free extends Discount
{
    protected $discount_product_name = "";
    protected $get_1_id              = null;
    protected $get_free_id           = null;

    public function run_rule(Cart $cart) : void
    {
        $has_product = false;
        $has_gift    = false;

        foreach ($cart->get_items() as $item)
        {
            $item->get_id() === $this->get_1_id && $has_product = true;
            $item->get_id() === $this->get_free_id && $has_gift = true;

            if ( $has_product && $has_gift )
            {
                break;
            }
        }

        if ( $has_product && $has_gift )
        {
            foreach ($cart->get_items() as $item)
            {
                if ( $item->get_id() === $this->get_free_id )
                {
                    $cart->add_product($this->create_discount_product_of_has_gift());
                    break;
                }
            }
        }
        if ( $has_product && ! $has_gift )
        {
            $cart->add_product($this->create_discount_product_of_no_gift());
        }
    }

    public function create_discount_product() : Product
    {
        // TODO 改成靜態物件
        return (new product($this->get_free_id))
            ->set_name($this->discount_product_name)
            ->set_discount_class_name(static::class)
            ->set_discount_product(true);
    }

    private function create_discount_product_of_has_gift() : product
    {
        return $this->create_discount_product()->set_price(config("product.{$this->get_free_id}.price") * -1);
    }

    private function create_discount_product_of_no_gift() : product
    {
        return $this->create_discount_product()->set_price(0);
    }
}
