<?php

use App\Services\Cart;
use App\Models\Category;
use App\Models\Wine;

test('a product can be added to the cart', function () {
    $cart = app(Cart::class);

    $category = Category::create([
        'name' => 'Categoría 0A',
        'description' => 'Descripción de la Categoría 0A.',
        'image' => 'categoria-0a.jpg',
    ]);

    $wine = Wine::create([
        'category_id' => $category->id,
        'name' => 'Vino Riojano',
        'description' => 'Descripción del Vino Riojano.',
        'year' => 2002,
        'price' => 28.74,
        'stock' => 11,
        'image' => 'vino-riojano.jpg',
    ]);

    // ----------------------------------------------------------------------------------------

    // [ esperando que el carrito esté vacío ]

    expect($cart->isEmpty())->toBe(true);

    // ----------------------------------------------------------------------------------------

    // [ esperando que el carrito no esté vacío y que total de elementos sea de 1 ]

    $cart->add($wine);

    expect($cart->isEmpty())->toBe(false)
        ->and($cart->getCart()->count())->toBe(1);

    // ----------------------------------------------------------------------------------------

    // [ esperando que el carrito esté vacío y que total de elementos sea de 0 ]

    $cart->clear();

    expect($cart->isEmpty())->toBe(true)
        ->and($cart->getCart()->count())->toBe(0);

    // ----------------------------------------------------------------------------------------

    // [ esperando que la cantidad total de elementos en el carrito sea de 2
    //   y que el coste total sea igual a (2 * $wine->price) ]

    $quantity = 2;
    $cart->add($wine, $quantity);

    expect($cart->getTotalQuantity())->toBe($quantity)
        ->and($cart->getTotalCost())->toBe(($wine->price * $quantity));

    // ----------------------------------------------------------------------------------------

    // [ incrementar de uno la cantidad total de elementos en el carrito, siendo ahora de 3
    //   y, por tanto, que el coste total sea igual a (3 * $wine->price) ]

    $quantity++;
    $cart->increment($wine);

    expect($cart->getTotalQuantity())->toBe($quantity)
        ->and($cart->getTotalCost())->toBe(($wine->price * $quantity));

    // ----------------------------------------------------------------------------------------

    // [ decrementar de uno la cantidad total de elementos en el carrito, siendo ahora de 2
    //   y, por tanto, que el coste total sea igual a (2 * $wine->price) ]

    $quantity--;
    $cart->decrement($wine->id);

    expect($cart->getTotalQuantity())->toBe($quantity)
        ->and($cart->getTotalCost())->toBe(($wine->price * $quantity));

    // ----------------------------------------------------------------------------------------

    // [ eliminar el elemento añadido anteriormente al carrito por lo que el propio carrito volverá a estar vacío
    //   y, además, la cantidad total de elementos será de 0 y el coste total será igual a 0.00 ]

    $cart->remove($wine->id);

    expect($cart->isEmpty())->toBe(true)
        ->and($cart->getTotalQuantity())->toBe(0)
        ->and($cart->getTotalCost())->toBe((0.00));

    // ----------------------------------------------------------------------------------------

    // [ añadiendo todo el STOCK disponible del elemento al carrito esperando que la cantidad total de elementos
    //   en el carrito sea igual a dicho STOCK
    //   y que el coste total sea igual al ($wine->stock * $wine->price) ]

    $cart->add($wine, $wine->stock);

    expect($cart->getTotalQuantity())->toBe($wine->stock)
        ->and($cart->getTotalCost())->toBe(($wine->price * $wine->stock));
})->group('unit-cart');
