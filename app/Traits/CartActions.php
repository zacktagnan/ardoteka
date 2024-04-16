<?php

namespace App\Traits;

use Exception;

trait CartActions
{
    public function addProductToCart(): void
    {
        $wineId = request()->input('wine_id');
        $quantity = request()->input('quantity', 1);

        $wine = $this->repository->find($wineId);
        $this->cart->add($wine, $quantity);
        session()->flash('success', __('Elemento añadido al carrito'));
    }

    public function incrementProductQuantity(): void
    {
        $wine = $this->repository->find(request('wine_id'));

        try {
            $this->cart->increment($wine);
            session()->flash('success', __('Cantidad incrementada'));
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
    }

    public function decrementProductQuantity(): void
    {
        // $this->cart->decrement(request('wine_id'));
        // session()->flash('success', __('Cantidad decrementada'));
        $itemExistInCart = $this->cart->decrement(request('wine_id'));
        if ($itemExistInCart) {
            session()->flash('success', __('Cantidad decrementada'));
        } else {
            session()->flash('success', __('Elemento eliminado del carrito tras decrementar a 0'));
        }
    }

    public function removeProduct(): void
    {
        $this->cart->remove(request('wine_id'));
        session()->flash('success', __('Elemento eliminado del carrito'));
    }

    public function clearCart(): void
    {
        $this->cart->clear();
        session()->flash('success', __('Carrito vaciado'));
    }
}
