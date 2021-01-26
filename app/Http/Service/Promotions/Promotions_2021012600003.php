<?php

namespace App\Http\Service\Promotions;

use \App\Http\Service\Discount\Abs\Discount_get_10_get_discount;

class Promotions_2021012600003 extends Discount_get_10_get_discount
{
    public function __construct()
    {
        $this->get_10_id             = 2021012600003;
        $this->get_discount_price    = 2199;
        $get_10_name                 = config("product.{$this->get_10_id}.name");
        $this->discount_product_name = "[{$get_10_name}] 滿10件優惠價格的折扣商品";
    }
}
