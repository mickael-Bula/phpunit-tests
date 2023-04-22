<?php

namespace App\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;

class Product
{
    const FOOD_PRODUCT = 'food';
    private $name;
    private $type;
    private $price;

    public function __construct($name, $type, $price)
    {
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
    }
    public function computeTVA()
    {
        if (self::FOOD_PRODUCT == $this->type) {

            return $this->price * 0.055;
        }

        return "{$this->name} n'est pas du type produit";
    }
}
