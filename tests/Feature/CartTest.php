<?php

use App\Models\Wine;
use App\Models\Category;
use App\Models\User;
use App\Services\Cart;

test('a product can be added to the cart - by the user', function () {
    $cart = app(Cart::class);

    $category = Category::create([
        'name' => 'Categoría 0A',
        'description' => 'Descripción de la Categoría 0A.',
        'image' => 'categoria-0a.jpg',
    ]);

    $wine1 = Wine::create([
        'category_id' => $category->id,
        'name' => 'Vino Riojano',
        'description' => 'Descripción del Vino Riojano.',
        'year' => 2010,
        'price' => 28,
        'stock' => 7,
        'image' => 'vino-riojano.jpg',
    ]);

    $wine2 = Wine::create([
        'category_id' => $category->id,
        'name' => 'Vino Burdeos',
        'description' => 'Descripción del Vino Burdeos.',
        'year' => 2011,
        'price' => 11,
        'stock' => 4,
        'image' => 'vino-burdeos.jpg',
    ]);

    $user = User::factory()->create();

    $this->actingAs($user);

    // ----------------------------------------------------------------------------------------

    // [ accediendo a la ruta pertinente para añadir una determinada cantidad de un determinado Wine
    //   y ver que todo lo relativo a las cifras es correcto ]

    $quantity1 = 2;
    $this->post(route('shop.addToCart'), [
        'wine_id' => $wine1->id,
        'quantity' => $quantity1,
    ]);

    expect($cart->isEmpty())->toBe(false)
        ->and($cart->getTotalQuantity())->toBe($quantity1)
        ->and($cart->getTotalCost())->toBe($wine1->price * $quantity1)
        ->and($cart->getTotalQuantityForWine($wine1))->toBe($quantity1)
        ->and($cart->getTotalCostForWine($wine1))->toBe($wine1->price * $quantity1);

    // ----------------------------------------------------------------------------------------

    // [ accediendo a la ruta pertinente para añadir una determinada cantidad de otro determinado Wine
    //   y ver que todo lo relativo a las cifras es correcto al haberse sumado lo necesario a lo ya disponible ]

    $quantity2 = 3;
    $this->post(route('shop.addToCart'), [
        'wine_id' => $wine2->id,
        'quantity' => $quantity2,
    ]);

    expect($cart->getTotalQuantity())->toBe($quantity1 + $quantity2)
        ->and($cart->getTotalCost())->toBe(($wine1->price * $quantity1) + ($wine2->price * $quantity2))
        ->and($cart->getTotalQuantityForWine($wine2))->toBe($quantity2)
        ->and($cart->getTotalCostForWine($wine2))->toBe($wine2->price * $quantity2);
})->group('feature-cart');
