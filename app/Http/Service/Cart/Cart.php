<?php

namespace App\Http\Service\Cart;

use App\Http\Service\Discount\Abs\Discount;
use App\Http\Service\Product\Product;
use Exception;

class Cart
{
    private $product_list   = [];
    private $discount_list  = [];
    private $total          = 0;
    private $original_total = 0;
    private $discount_total = 0;


    private function _run_discount() : void
    {
        foreach ($this->discount_list as $discount)
        {
            $discount->filter($this);
        }
    }

    private function _calc_total() : void
    {
        $this->total = 0;
        $this->total = $this->get_original_total() + $this->get_discount_total();
    }

    private function _calc_original_total() : void
    {
        $this->original_total = 0;
        if ( isset($this->product_list[static::class]) )
        {
            foreach ($this->product_list[static::class] as $class_name => $product)
            {
                $this->original_total += $product->get_price();
            }
        }
    }

    private function _calc_discount_total() : void
    {
        $this->discount_total = 0;
        foreach ($this->product_list as $class_name => $discount_products)
        {
            if ( $class_name !== static::class )
            {
                foreach ($discount_products as $discount_product)
                {
                    $this->discount_total += $discount_product->get_price();
                }
            }
        }
    }

    public function add_discount(discount $discount) : void
    {
        $this->discount_list[] = $discount;
    }

    public function add_product($product) : void
    {
        try
        {
            if ( is_numeric($product) )
            {
                // TODO 改成靜態物件
                $this->add_product((new product($product))->set_discount_class_name(static::class));
            }
            elseif ( $product instanceof product )
            {
                $this->product_list[$product->get_discount_class_name()][] = $product;
            }
            else
            {
                throw new Exception('$product not numeric or not a product object.');
            }
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function del_discount_product(string $discount_class_name) : void
    {
        unset($this->product_list[$discount_class_name]);
    }

    public function get_total() : int
    {
        $this->_calc_total();
        return $this->total;
    }

    public function get_original_total() : int
    {
        $this->_calc_original_total();
        return $this->original_total;
    }

    public function get_discount_total() : int
    {
        $this->_calc_discount_total();
        return $this->discount_total;
    }

    public function get_items() : array
    {
        $list = [];
        foreach ($this->product_list as $class_name => $products)
        {
            foreach ($products as $product)
            {
                $list[] = $product;
            }
        }
        return $list;
    }

    public function get_quantity(int $product_id) : int
    {
        try
        {
            if ( ! is_numeric($product_id) )
            {
                throw new Exception('Not numeric.');
            }
            if ( ! empty($this->product_list[static::class]) )
            {
                $total = 0;
                foreach ($this->product_list[static::class] as $product)
                {
                    if ( $product->get_id() === $product_id )
                    {
                        $total += 1;
                    }
                }
            }

            return $total ?? 0;
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return 0;
        }
    }

    public function total() : int
    {
        $this->_run_discount();
        $this->show_detail();
        return $this->get_total();
    }

    public function show_detail() : void
    {
        echo "====================================================<br>";
        echo "購物車內：商品總金額：{$this->get_original_total()}\t優惠金額：{$this->get_discount_total()}\t總計金額：{$this->get_total()}<br>";
        foreach ($this->get_items() as $product)
        {
            echo "\t價格：{$product->get_price()}\t 商品：{$product->get_name()}<br>";
        }
    }

    public function init() : void
    {
        $this->product_list   = [];
        $this->discount_list  = [];
        $this->total          = 0;
        $this->original_total = 0;
        $this->discount_total = 0;
    }
}
