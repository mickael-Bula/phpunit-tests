<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use Exception;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testDefault()
    {
        $product = new Product('Pomme', 'food', 1);
        $this->assertSame(0.055, $product->computeTVA());
    }

    public function testComputeTVAFoodProduct()
    {
        $product = new Product('Produit', Product::FOOD_PRODUCT, 20);
        $this->assertSame(1.1, $product->computeTVA());
    }

    public function testComputeTVAOtherProduct()
    {
        $product = new Product('un autre produit', 'un autre type de produit', 20);
        $this->assertSame(3.92, $product->computeTVA());
    }

    public function testNegativePriceComputeTVA()
    {
        $product = new Product('un produit', Product::FOOD_PRODUCT, -5);
        // La méthode expectException() prend en paramètre une chaîne de caractères correspondant au FQCN de l'exception attendue
        $this->expectException('Exception');
        // après avoir déclaré le type d'exception attendu, on lance l'exécution de la méthode à tester
        $product->computeTVA();
    }

    /**
     * @dataProvider pricesForFoodProduct
     * @throws Exception
     */
    public function testComputeTVAFoodProductProvided($price, $expectedTVA)
    {
        $product = new Product('un produit', Product::FOOD_PRODUCT, $price);
        $this->assertSame($expectedTVA, $product->computeTVA());
    }

    public function pricesForFoodProduct(): array
    {
        return [
            [0, 0.0],
            [20, 1.1],
            [100, 5.5]
        ];
    }
}