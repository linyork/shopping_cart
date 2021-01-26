<?php

namespace App\Http\Service\Product;

use App\Exceptions\ProductException;

class Product
{
    private $id;
    private $name;
    private $price;
    private $discount_class_name;
    private $discount_product;

    public function __construct(int $id)
    {
        if ( ! config("product.{$id}") )
        {
            throw new ProductException('No this id\'s product.');
        }
        $this->set_id($id);
        $this->set_name(config("product.{$id}.name"));
        $this->set_price(config("product.{$id}.price"));
        $this->set_discount_product(false);
    }

    private function set_id(int $id) : self
    {
        $this->id = $id;
        return $this;
    }

    public function set_name(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    public function set_price(float $price) : self
    {
        $this->price = $price;
        return $this;
    }

    public function set_discount_class_name(string $discount_class_name) : self
    {
        $this->discount_class_name = $discount_class_name;
        return $this;
    }

    public function set_discount_product(bool $discount_product) : self
    {
        $this->discount_product = $discount_product;
        return $this;
    }

    public function get_id() : int
    {
        return $this->id;
    }

    public function get_name() : string
    {
        return $this->name;
    }

    public function get_price() : float
    {
        return $this->price;
    }

    public function get_discount_class_name() : string
    {
        return $this->discount_class_name;
    }

    public function get_discount_product() : bool
    {
        return $this->discount_product;
    }
}
