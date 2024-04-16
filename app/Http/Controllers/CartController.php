<?php

namespace App\Http\Controllers;

use App\Services\Cart;
use Illuminate\View\View;
use App\Traits\CartActions;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Shop\ShopRepositoryInterface;

class CartController extends Controller
{
    use CartActions;

    public function __construct(private readonly ShopRepositoryInterface $repository, private readonly Cart $cart)
    {
        // -> Para visualizar el contenido actual del CART en todo momento...
        // ray($this->cart->getCart());
    }

    public function index(): View
    {
        return view('cart.index');
    }

    public function increment(): RedirectResponse
    {
        $this->incrementProductQuantity();
        return redirect()->route('cart.index');
    }

    public function decrement(): RedirectResponse
    {
        $this->decrementProductQuantity();
        return redirect()->route('cart.index');
    }

    public function remove(): RedirectResponse
    {
        $this->removeProduct();
        return redirect()->route('cart.index');
    }

    public function clear(): RedirectResponse
    {
        $this->clearCart();
        return redirect()->route('cart.index');
    }
}
