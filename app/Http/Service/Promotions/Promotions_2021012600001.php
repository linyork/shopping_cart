<?php

namespace App\Http\Service\Promotions;

use App\Http\Service\Discount\Abs\Discount_get_1_get_free;

class Promotions_2021012600001 extends Discount_get_1_get_free
{
    public function __construct()
    {
        $this->get_1_id              = 2021012600001;
        $this->get_free_id           = 2021012600002;
        $get_1_name                  = config("product.{$this->get_1_id}.name");
        $get_free_name               = config("product.{$this->get_free_id}.name");
        $this->discount_product_name = "買 [{$get_1_name}] 送 [{$get_free_name}] 活動的折扣商品";
    }
}
