<?php

namespace App\Http\Controllers;

use App\Repositories\Shop\ShopRepositoryInterface;
use App\Services\Cart;
use App\Traits\CartActions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    use CartActions;

    public function __construct(private readonly ShopRepositoryInterface $repository, private readonly Cart $cart)
    {
        // -> Para visualizar el contenido actual del CART en todo momento...
        ray($this->cart->getCart());
    }

    public function index(): View
    {
        // -> Contando las consulta realizadas hasta conseguir el resultado de la consulta final
        // ray()->countQueries(fn () => $this->repository->paginate());

        // -> Observando las consultas efectuadas hasta conseguir el resultado de la consulta final
        // ray()->showQueries();
        // -> Observando las consultas duplicadas
        // ray()->showDuplicateQueries();

        $wines = $this->repository->paginate();
        return view('shop.index', compact('wines'));
    }

    public function addToCart(): RedirectResponse
    {
        $this->addProductToCart();
        return redirect()->route('shop.index');
    }

    public function increment(): RedirectResponse
    {
        $this->incrementProductQuantity();
        return redirect()->route('shop.index');
    }

    public function decrement(): RedirectResponse
    {
        $this->decrementProductQuantity();
        return redirect()->route('shop.index');
    }

    public function remove(): RedirectResponse
    {
        $this->removeProduct();
        return redirect()->route('shop.index');
    }
}
