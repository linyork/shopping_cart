<?php

namespace App\Http\Service\Promotions;

use \App\Http\Service\Discount\Abs\Discount_get_3_free_1;

class Promotions_2021012600004 extends Discount_get_3_free_1
{
    public function __construct()
    {
        $this->get_free_id           = 2021012600004;
        $get_free_name               = config("product.{$this->get_free_id}.name");
        $this->discount_product_name = "[{$get_free_name}] 買三送一的折扣商品";
    }
}
