<?php

namespace App\Http\Controllers;

use App\Http\Service\Promotions\Promotions_2021012600004;
use App\Http\Service\Promotions\Promotions_2021012600001;
use App\Http\Service\Promotions\Promotions_2021012600003;
use App\Http\Service\Cart\cart;

class Index extends Controller
{

    public function index(Cart $cart)
    {
        $cart->add_discount(resolve(Promotions_2021012600004::class));
        $cart->add_discount(resolve(Promotions_2021012600001::class));
        $cart->add_discount(resolve(Promotions_2021012600003::class));
        $cart->add_product(2021012600001);
        $cart->add_product(2021012600002);
        $cart->add_product(2021012600003);
        $cart->add_product(2021012600003);
        $cart->add_product(2021012600003);
        $cart->add_product(2021012600003);
        $cart->add_product(2021012600003);
        $cart->add_product(2021012600003);
        $cart->add_product(2021012600003);
        $cart->add_product(2021012600003);
        $cart->add_product(2021012600003);
        $cart->add_product(2021012600003);
        $cart->add_product(2021012600004);
        $cart->add_product(2021012600004);
        $cart->add_product(2021012600004);
        $cart->add_product(2021012600005);
        $cart->total();
        $cart->init();
    }
}
