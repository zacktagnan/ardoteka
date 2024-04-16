<?php

namespace App\Repositories\Shop;

use App\Models\Wine;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentShopRepository implements ShopRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        // -> Observando la consulta realizada
        // return Wine::query()->ray()->paginate($perPage);
        // return Wine::paginate($perPage);
        // Consulta más optimizada por incluir la relationShip
        return Wine::with('category')->paginate($perPage);
    }

    public function find(int $id): Wine
    {
        return Wine::findOrFail($id);
    }
}
