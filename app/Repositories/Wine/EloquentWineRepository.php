<?php

namespace App\Repositories\Wine;

use App\Models\Wine;
use App\Traits\Eloquent\CRUDOperations;

class EloquentWineRepository implements WineRepositoryInterface
{
    use CRUDOperations;

    protected string $model = Wine::class;
}
